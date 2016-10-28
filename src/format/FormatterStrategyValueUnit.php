<?php

namespace money\format;
use money\Money;
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
class FormatterStrategyValueUnit extends FormatterAbstract
{
    private $numberFormatter;
    private $pattern;
    private $fractionDigits;
    public  function __construct($fractionDigits = null)
    {
        if(isset($fractionDigits) && !is_int($fractionDigits))
        {
            throw new \Exception('$factionDigits must be int');
        }
        $this->fractionDigits = $fractionDigits;
    }

    //货币格式化
    public function format(Money $money)
    {
        $unit = $money->getCurrency()->getUnit();
        if(!isset($this->fractionDigits))
        {
            return $money->getAmount().$unit;
        }
        $this->handlePattern($unit,$this->fractionDigits);
        $local = $money->getCurrency()->getLocal();
        $this->numberFormatter = new \NumberFormatter($local,\NumberFormatter::CURRENCY);
        $this->numberFormatter->setPattern($this->pattern);
        return $this->numberFormatter->formatCurrency(
            $money->getAmount(),
            $money->getCurrency()->getCurrencyCode()
        );
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function handlePattern($unit,$fractionDigits)
    {
        return $this->pattern='###,###,###,###.'.str_repeat('0',$fractionDigits).$unit;

    }

}