<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 8/26/16
 * Time: 8:54 PM
 */

namespace Ann\lib;


class Network
{
    private $neurons = [];

    public function __construct(array $tasksNames, int $sizeY, int $sizeX, int $limit = null)
    {
        foreach ($tasksNames as $taskName) {
            $this->neurons[$taskName] = new Neuron($taskName, $sizeY, $sizeX, $limit);
        }
    }

    public function setInput(array $input)
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

    public function saveWeights()
    {
        foreach ($this->neurons as $neuron) {
            $neuron->saveWeights();
        }

        return $this;
    }

}