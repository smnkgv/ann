<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 8/13/16
 * Time: 2:24 AM
 */

namespace smnkgv\ann\lib;

class Neuron
{
    private $input = [];
    private $limit;
    private $weights = [];
    private $sizeY;
    private $sizeX;

    public function __construct(array &$weights, int $sizeY, int $sizeX, int $limit = null)
    {
        if (empty($weights)) {
            throw new \InvalidArgumentException('Weights are empty');
        }

        if ($sizeX < 1 || $sizeY < 1) {
            throw new \Exception('Incorrect input size');
        }

        if ($limit && $limit < 1) {
            throw new \Exception('Incorrect limit');
        }

        $this->sizeY = $sizeY;
        $this->sizeX = $sizeX;
        $this->limit = $limit ?? 10;
        $this->weights = &$weights;
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

    private function multiplyInputByWeights(): array
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