<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 8/26/16
 * Time: 8:54 PM
 */

namespace smnkgv\ann\lib;


class Network
{
    private $taskName;
    private $neuronsNames = [];
    private $neurons = [];
    private $weightsFile;
    private $weights = [];
    private $sizeY;
    private $sizeX;

    public function __construct(string $taskName, array $neuronsNames, int $sizeY, int $sizeX, int $limit = null)
    {
        $this->taskName = $taskName;
        $this->neuronsNames = $neuronsNames;
        $this->weightsFile = __DIR__ . "/../weights/$taskName.txt";
        $this->sizeY = $sizeY;
        $this->sizeX = $sizeX;
        $this->weights = $this->getWeights();

        foreach ($this->weights as $neuronName => &$weight) {
            $this->neurons[$neuronName] = new Neuron($weight, $sizeY, $sizeX, $limit);
        }
    }

    public function saveWeights()
    {
        if (empty($this->weights)) {
            throw new \Exception('Nothing to save');
        }

        $serializedWeights = json_encode($this->weights);
        file_put_contents($this->weightsFile, $serializedWeights);
    }

    private function getWeights(): array
    {
        if (!file_exists($this->weightsFile)) {
            $result = $this->initWeights();

            if ($result === false) {
                throw new \Exception('Weights file cannot be created');
            }
        }

        $weightsString = file_get_contents($this->weightsFile);
        $weights = json_decode($weightsString, true);

        return $weights;
    }

    private function initWeights()
    {
        $values = [];
        for ($y = 0; $y <= $this->sizeY - 1; $y++) {
            for ($x = 0; $x <= $this->sizeX - 1; $x++) {
                $values[$y][$x] = 0;
            }
        }

        $result = [];
        foreach ($this->neuronsNames as $neuronName) {
            $result["$neuronName"] = $values;
        }

        $resultSerialized = json_encode($result);
        $result = file_put_contents($this->weightsFile, $resultSerialized);

        return $result;
    }

    public function setInput(array $input): Network
    {
        foreach ($this->neurons as $neuron) {
            $neuron->setInput($input);
        }

        return $this;
    }

    public function getResults(): array
    {
        $results = [];
        foreach ($this->neurons as $taskName => $neuron) {
            $results[$taskName] = $neuron->getResult();
        }

        return $results;
    }

    public function getNeuron(string $taskName): Neuron
    {
        return $this->neurons[$taskName];
    }

    public function getNeurons(): array
    {
        return $this->neurons;
    }
}