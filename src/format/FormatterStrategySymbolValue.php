<?php

namespace money\format;

use money\Money;
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
class FormatterStrategySymbolValue extends FormatterAbstract
{
    private $numberFormatter;
    private $pattern;
    private $fractionDigits;
    public function __construct($fractionDigits = null)
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
        $symbol = $money->getCurrency()->getSymbol();
        if(!isset($this->fractionDigits))
        {
            return $symbol.$money->getAmount();
        }
        $this->handlePattern($symbol,$this->fractionDigits);
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
    //设置显示模式
    public function handlePattern($symbol,$fractionDigits)
    {
        return $this->pattern=$symbol.'###,###,###,###.'.str_repeat('0',$fractionDigits);

    }

}