<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 8/13/16
 * Time: 2:24 AM
 */

namespace Ann\lib;

class Neuron
{
    private $taskName;
    private $input = [];
    private $limit;
    private $weights = [];
    private $sizeY;
    private $sizeX;

    public function __construct(string $taskName, int $sizeY, int $sizeX, int $limit = null)
    {
        $this->sizeY = $sizeY;
        $this->sizeX = $sizeX;
        $this->limit = $limit ?? 10;
        $this->taskName = $taskName;
        $this->weightsFile = __DIR__ . "/../weights/$taskName.txt";
        $this->weights = $this->loadWeights();
    }

    public function setInput(array $input)
    {
        $this->input = $input;

        return $this;
    }

    public function getResult(): int
    {
        $multipliedInputByWeights = $this->multiplyInputByWeights();
        $sum = $this->getSum($multipliedInputByWeights);
        $result = $this->checkLimit($sum);

        return $result;
    }

    public function isFalseTrue()
    {
        for ($y = 0; $y <= $this->sizeY - 1; $y++) {
            for ($x = 0; $x <= $this->sizeX - 1; $x++) {
                $this->weights[$y][$x] -= $this->input[$y][$x];
            }
        }
    }

    public function isFalseFalse()
    {
        for ($y = 0; $y <= $this->sizeY - 1; $y++) {
            for ($x = 0; $x <= $this->sizeX - 1; $x++) {
                $this->weights[$y][$x] += $this->input[$y][$x];
            }
        }
    }

    public function saveWeights()
    {
        if (empty($this->weights)) {
            throw new \Exception('Nothing to save');
        }

        $serializedWeights = serialize($this->weights);
        file_put_contents($this->weightsFile, $serializedWeights);
    }

    private function loadWeights(): array
    {
        if (!file_exists($this->weightsFile)) {
            $result = $this->initWeights($this->weightsFile);

            if ($result === false) {
                throw new \Exception('Weights file cannot be created');
            }
        }

        $weightsString = file_get_contents($this->weightsFile);
        $weights = unserialize($weightsString);

        return $weights;
    }

    private function initWeights(string $weightsFile)
    {
        $values = [];
        for ($y = 0; $y <= $this->sizeY - 1; $y++) {
            for ($x = 0; $x <= $this->sizeX - 1; $x++) {
                $values[$y][$x] = 0;
            }
        }

        $valuesSerialized = serialize($values);
        $result = file_put_contents($weightsFile, $valuesSerialized);

        return $result;
    }

    private function multiplyInputByWeights()
    {
        $result = [];
        for ($y = 0; $y <= $this->sizeY - 1; $y++) {
            for ($x = 0; $x <= $this->sizeX - 1; $x++) {
                $result[$y][$x] = $this->input[$y][$x] * $this->weights[$y][$x];
            }
        }

        return $result;
    }

    private function getSum(array $inputWithWeight): int
    {
        $sum = 0;
        for ($y = 0; $y <= $this->sizeY - 1; $y++) {
            for ($x = 0; $x <= $this->sizeX - 1; $x++) {
                $sum += $inputWithWeight[$y][$x];
            }
        }

        return $sum;
    }

    private function checkLimit(float $sum): int
    {
        return $sum >= $this->limit;
    }

}