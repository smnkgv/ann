<?php

namespace Ann\tests;

use Ann\lib\Network;
use Codeception\Util\Debug;

class NetworkTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    const LETTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function _before()
    {
        parent::_before();

        $this->trainNetwork(); //you should comment this line after first run
    }

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

    private function trainNetwork()
    {
        $lettersArray = str_split(self::LETTERS);
        $sansLettersArray = array_map(function ($one) {
            $one = "sans_$one";
            return $one;
        }, $lettersArray);
        $imagesGrayInPercents = array_reduce($lettersArray, function ($memo, $letter) {
            $image = $this->createTestImage($letter);
            $this->savePngImage($image, $letter); //not really needed
            $imageGrayPercents = $this->getImageGrayPercents($image);
            $memo[$letter] = $imageGrayPercents;

            return $memo;
        }, []);

        $network = new Network($sansLettersArray, 50, 50);

        for ($i = 0; $i < 30; $i++) {
            foreach ($imagesGrayInPercents as $letter => $oneImage) {
                $network->setInput($oneImage);
                $results = $network->getResults();

                foreach ($results as $taskName => $result) {
                    if ($taskName === "sans_$letter") {
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

    public function testNetwork()
    {
        $lettersArray = str_split(self::LETTERS);
        shuffle($lettersArray);
        $sansLettersArray = array_map(function ($one) {
            $one = "sans_$one";
            return $one;
        }, $lettersArray);
        $imagesGrayInPercents = array_reduce($lettersArray, function ($memo, $letter) {
            $image = $this->createTestImage($letter);
            $imageGrayPercents = $this->getImageGrayPercents($image);
            $memo[$letter] = $imageGrayPercents;

            return $memo;
        }, []);

        $network = new Network($sansLettersArray, 50, 50);

        $goodRecognitions = 0;
        foreach ($imagesGrayInPercents as $letter => $oneImage) {
            $network->setInput($oneImage);
            $results = $network->getResults();
            $resultsFiltered = array_filter($results, function ($one) {
                return $one === 1;
            });
            $resultsFilteredValues = array_keys($resultsFiltered);
            $implodeResults = implode(', ', $resultsFilteredValues);

            Debug::debug("image $letter looks like $implodeResults");

            if ("sans_$letter" == $implodeResults) {
                $goodRecognitions++;
            }
        }

        $accuracy = round($goodRecognitions * 100 / count($lettersArray), 2);

        Debug::debug("Accuracy: $accuracy%");

        $this->assertTrue($accuracy >= 95);
    }

}