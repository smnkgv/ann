<?php

namespace smnkgv\ann\tests;

use smnkgv\ann\lib\Network;
use Codeception\Util\Debug;

class NetworkTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    const LETTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private function createTestImage(string $string)
    {
        $im = imagecreatetruecolor(50, 50);

        $white = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 50, 50, $white);
        $font = __DIR__ . "/../../_data/OpenSans-Regular.ttf";

        imagettftext($im, 30, 0, 10, 40, $black, $font, $string);

        return $im;
    }

    private function getImageGrayPercents($image): array
    {
        $width = imagesx($image);
        $height = imagesy($image);

        $colors = [];
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $rgb = imagecolorat($image, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $gray = ($r + $g + $b) / 3;
                $blackPixel = 1 - ($gray / 255);
                $colors[$y][$x] = round($blackPixel, 2);
            }
        }

        return $colors;
    }

    private function savePngImage($image, string $name)
    {
        imagepng($image, __DIR__ . "/../../_output/$name.png");
    }

    private function getImagesGrayInPercents(array $letters, bool $shuffle = false): array
    {
        if ($shuffle) {
            shuffle($letters);
        }

        $imagesGrayInPercents = array_reduce($letters, function ($memo, $letter) {
            $image = $this->createTestImage($letter);
            $this->savePngImage($image, $letter); //not really needed
            $imageGrayPercents = $this->getImageGrayPercents($image);
            $memo[$letter] = $imageGrayPercents;

            return $memo;
        }, []);

        return $imagesGrayInPercents;
    }

    private function trainImageRecognitionNetwork()
    {
        $lettersArray = str_split(self::LETTERS);
        $imagesGrayInPercents = $this->getImagesGrayInPercents($lettersArray);

        $network = new Network('sans-recognition', $lettersArray, 50, 50);

        for ($i = 0; $i < 30; $i++) {
            $iteration = $i + 1;
            Debug::debug("Train iteration: $iteration");

            foreach ($imagesGrayInPercents as $letter => $oneImage) {
                $network->setInput($oneImage);
                $results = $network->getResults();

                foreach ($results as $taskName => $result) {
                    if ($taskName === $letter) {
                        if ($result === 0) {
                            $network->getNeuron($taskName)->isFalseFalse();
                        }
                    } else {
                        if ($result === 1) {
                            $network->getNeuron($taskName)->isFalseTrue();
                        }
                    }
                }
            }
        }

        $network->saveWeights();
    }

    public function testImageRecognitionNetwork()
    {
//        $this->trainImageRecognitionNetwork(); //this can be disabled right after the first run

        $lettersArray = str_split(self::LETTERS);
        $imagesGrayInPercents = $this->getImagesGrayInPercents($lettersArray, true);

        $network = new Network('sans-recognition', $lettersArray, 50, 50);

        $goodRecognitions = 0;
        foreach ($imagesGrayInPercents as $letter => $oneImage) {
            $network->setInput($oneImage);
            $results = $network->getResults();
            $resultsFiltered = array_filter($results, function ($one) {
                return $one === 1;
            });
            $resultsFilteredValues = array_keys($resultsFiltered);
            $implodeResults = implode(', ', $resultsFilteredValues);

            Debug::debug("real / recognized: $letter / $implodeResults");

            if ($letter == $implodeResults) {
                $goodRecognitions++;
            }
        }

        $accuracy = round($goodRecognitions * 100 / count($lettersArray), 2);

        Debug::debug("Accuracy: $accuracy%");

        $this->assertGreaterThanOrEqual(95, $accuracy);
    }
}