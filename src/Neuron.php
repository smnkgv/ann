<?php

namespace smnkgv\ann\src;

class Neuron
{
    private $input = [];
    private $weights = [];
    private $inputsCount;

    public function __construct(int $inputsCount, array $weights = [])
    {
        if ($inputsCount < 1) {
            throw new \InvalidArgumentException('Number of inputs is incorrect');
        }

        if (empty($weights)) {
            throw new \InvalidArgumentException('Weights are empty');
        }

        $this->inputsCount = $inputsCount;
        $this->weights = $weights || $this->generateWeights();
    }

    public function setInput(array $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function getOutput(): float
    {
        $weightedSum = $this->calcWeightedSum();
        $result = $this->calcSigmoid($weightedSum);

        return $result;
    }

    public function getWeights(): array
    {
        return $this->weights;
    }

    private function generateWeights(): array
    {
        $weights = [];
        for ($i = 0; $i < $this->inputsCount; $i++) {
            $weights[] = 2 * (mt_rand() / mt_getrandmax()) - 1;
        }

        return $weights;
    }

    private function calcWeightedSum(): float
    {
        $sum = 0;
        for ($i = 0; $i <= $this->inputsCount - 1; $i++) {
            $sum += $this->input[$i] * $this->weights[$i];
        }

        return $sum;
    }

    private function calcSigmoid(float $weightedSum): float
    {
        return 1 / (1 + exp(-$weightedSum));
    }

    private function calcSigmoidDerivative(float $sigmoid): float
    {
        return $sigmoid * (1 - $sigmoid);
    }

}