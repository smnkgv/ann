<?php

namespace smnkgv\ann\src;

class Layer
{
    /** @var  Neuron[] */
    private $neurons;
    private $neuronsCount;
    private $inputsCount;

    public function __construct(int $neuronsCount, int $inputsCount, array $layerWeights = [])
    {
        for ($i = 0; $i < $neuronsCount; $i++) {
            $this->neurons[] = new Neuron($inputsCount, $layerWeights[$i]);
        }

        $this->neuronsCount = $neuronsCount;
        $this->inputsCount = $inputsCount;
    }

    public function getNeurons(): array
    {
        return $this->neurons;
    }

    public function getInputs(): int
    {
        return $this->inputsCount;
    }

    public function getNeuronsCount(): int
    {
        return $this->neuronsCount;
    }

    public function getWeights(): array
    {
        $weights = [];
        foreach ($this->neurons as $index => $neuron) {
            $weights[$index] = $neuron->getWeights();
        }

        return $weights;
    }

    public function getOutput(): array
    {
        $outputClasses = [];
        foreach ($this->neurons as $index => $neuron) {
            $outputClasses[$index] = $neuron->getOutput();
        }

        return $outputClasses;
    }

    public function setInputs(array $inputs): self
    {
        foreach ($this->neurons as $neuron) {
            $neuron->setInput($inputs);
        }
    }
}