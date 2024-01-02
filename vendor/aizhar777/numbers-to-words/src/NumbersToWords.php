<?php

namespace Aizhar777\NumToWord;


use Aizhar777\Exceptions\MissingDozensNumbersException;
use Aizhar777\Exceptions\MissingHundredsNumbersException;
use Aizhar777\Exceptions\MissingTenNumbersException;
use Aizhar777\Exceptions\MissingTwentyNumbersException;
use Aizhar777\Exceptions\MissingUnitsNumbersException;
use Aizhar777\Exceptions\MissingZeroNumberException;

/**
 * Class NumbersToWords
 *
 * @author runcore
 * @author aizhar777
 */
class NumbersToWords
{
    /**
     * @var array
     */
    protected $config;

    /**
     * NumbersToWords constructor.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Возвращает сумму прописью
     *
     * @param $num
     * @return string
     */
    public function getStr($num)
    {
        $nul = $this->getZero();
        $ten = $this->getTen();
        $a20 = $this->getTwenty();
        $tens = $this->getDozens();
        $hundred = $this->getHundreds();
        $unit = $this->getUnits();
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = [];
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) {
                if (!intval($v)) {
                    continue;
                }
                $uk = sizeof($unit) - $uk - 1;
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                $out[] = $hundred[$i1];
                if ($i2 > 1) {
                    $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];
                } else {
                    $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];
                }
                if ($uk > 1) {
                    $out[] = $this->morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            }
        } else {
            $out[] = $nul;
        }
        $out[] = $this->morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]);
        $out[] = $kop . ' ' . $this->morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]);
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }


    /**
     * Склоняем словоформу
     */
    protected function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) {
            return $f5;
        }
        $n = $n % 10;
        if ($n > 1 && $n < 5) {
            return $f2;
        }
        if ($n == 1) {
            return $f1;
        }
        return $f5;
    }

    /**
     * Units
     *
     * @return array
     */
    protected function getUnits()
    {
        if (empty($this->config['units']))
            throw new MissingUnitsNumbersException();

        return $this->config['units'];
    }

    /**
     * Hundreds
     *
     * @return array
     */
    protected function getHundreds()
    {
        if (empty($this->config['hundreds']))
            throw new MissingHundredsNumbersException();

        return $this->config['hundreds'];
    }

    /**
     * Dozens
     *
     * @return array
     */
    protected function getDozens()
    {
        if (empty($this->config['dozens']))
            throw new MissingDozensNumbersException();

        return $this->config['dozens'];
    }

    /**
     * Twenty
     *
     * @return array
     */
    protected function getTwenty()
    {
        if (empty($this->config['twenty']))
            throw new MissingTwentyNumbersException();

        return $this->config['twenty'];
    }

    /**
     * Ten
     *
     * @return array
     */
    protected function getTen()
    {
        if (empty($this->config['ten']))
            throw new MissingTenNumbersException();

        return $this->config['ten'];
    }

    /**
     * Zero
     *
     * @return string
     */
    protected function getZero()
    {
        if (empty($this->config['zero']))
            throw new MissingZeroNumberException();

        return $this->config['zero'];
    }
}