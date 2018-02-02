<?php

namespace smnkgv\ann\src;


class Network
{
    /** @var  Session */
    private $session;
    /** @var  Layer[] */
    private $layers;
    private $inputs;
    private $outputsClasses;
    private $hiddenLayers;
    private $trainData;

    public function __construct(string $sessionFile, int $inputs, int $outputsClasses, array $hiddenLayers = [])
    {
        if (!preg_match('/.+\.json$/i', $sessionFile)) {
            throw new \InvalidArgumentException('Incorrect session file');
        }

        if ($inputs < 1 || $outputsClasses < 1) {
            throw new \InvalidArgumentException('Incorrect number of inputs or outputs');
        }

        $this->session = new Session($sessionFile);
        $this->inputs = $inputs;
        $this->outputsClasses = $outputsClasses;
        $this->hiddenLayers = $hiddenLayers;

        $this->initInputLayer();
        $this->initHiddenLayers();
        $this->initOutputLayer();
    }

    public function setInput(array $input): self
    {
        $this->layers[0]->setInputs($input);

        return $this;
    }

    public function feedForward(): self
    {
        for ($i = 0; $i < count($this->layers) - 1; $i++) {
            $currentOutput = $this->layers[$i]->getOutput();
            $this->layers[$i + 1]->setInputs($currentOutput);
        }

        return $this;
    }

    public function getOutput(): array
    {
        return $this->layers[count($this->layers) - 1]->getOutput();
    }

    public function setTrainData(array $trainData): self
    {
        $this->trainData = $trainData;

        return $this;
    }

    public function saveSession(): bool
    {
        $weights = $this->getWeights();
        $this->session->setWeights($weights);
        $result = $this->session->save();

        return $result;
    }

    private function initInputLayer()
    {
        $this->layers[] = new Layer($this->inputs, $this->inputs);
    }

    private function initHiddenLayers()
    {
        foreach ($this->hiddenLayers as $layerNeuronsCount) {
            if (!is_int($layerNeuronsCount) || $layerNeuronsCount < 1) {
                throw new \InvalidArgumentException('Hidden layer must have a proper number of neurons');
            }

            $lastLayer = $this->getLastLayer();
            $lastLayerNeuronsCount = $lastLayer->getNeuronsCount();

            $this->layers[] = new Layer($layerNeuronsCount, $lastLayerNeuronsCount);
        }
    }

    private function initOutputLayer()
    {
        $lastLayer = $this->getLastLayer();
        $lastLayerNeuronsCount = $lastLayer->getNeuronsCount();

        $this->layers[] = new Layer($this->outputsClasses, $lastLayerNeuronsCount);
    }

    private function getLastLayer(): Layer
    {
        return $this->layers[count($this->layers) - 1];
    }

    private function getWeights(): array
    {
        $weights = [];
        foreach ($this->layers as $index => $layer) {
            $weights[$index] = $layer->getWeights();
        }

        return $weights;
    }

    private function doBackpropagation()
    {
        for ($i = count($this->layers) - 1; $i > 0; $i--) {
//            $current
        }

    }

    private function getLayerErrors()
    {

    }
}