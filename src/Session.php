<?php

namespace smnkgv\ann\src;

class Session
{
    private $file;
    private $isNew;
    private $weights;

    public function __construct(string $file)
    {
        if (!preg_match('/.+\.json$/i', $file)) {
            throw new \InvalidArgumentException('Incorrect session file');
        }

        $this->isNew = !file_exists($file);
        $this->file = $file;
    }

    public function load(): array
    {
        $serializedWeights = file_get_contents($this->file);
        $weights = json_decode($serializedWeights);

        return $weights;
    }

    public function setWeights(array $weights): self
    {
        $this->weights = $weights;

        return $this;
    }

    public function save(): bool
    {
        if (empty($this->weights)) {
            throw new \Exception('Nothing to save');
        }

        $serializedWeights = json_encode($this->weights);
        $result = file_put_contents($this->file, $serializedWeights);

        return $result !== false;
    }
}