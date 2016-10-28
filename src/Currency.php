<?php

/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
class Currency
{
    private  static $currencies = [
        'CNY' => [
            'display_name' => 'Yuan Renminbi',
            'default_fraction_digits' => 2,
            'symbol' => '￥',
            'unit'   => '元',
            'local'  => 'zh-CN'
        ],
        'USD' => [
            'display_name' => 'US Dollar',
            'default_fraction_digits' => 2,
            'symbol' => '$',
            'unit' => '$',
            'local'  => 'en-US'
        ],
        'EUR' => [
            'display_name' => 'Euro',
            'default_fraction_digits' => 2,
            'symbol' => '€',
            'unit' => '€',
            'local'  => 'en-GB'
        ],
    ];
    //编码
    private $currencyCode;

    public function __construct($currencyCode)
    {
        if (!isset(self::$currencies[$currencyCode])) {
            $currencyCode = strtoupper($currencyCode);
        }

        if (!isset(self::$currencies[$currencyCode])) {
            throw new Exception(
                sprintf('Unknown currency code "%s"', $currencyCode)
            );
        }
        $this->currencyCode = $currencyCode;
    }

    //返回货币集合
    public static function getCurrencies()
    {
        return self::$currencies;
    }

    //返回当前币种
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    //返回当前币种符号
    public function getSymbol()
    {
        return self::$currencies[$this->currencyCode]['symbol'];
    }
    //返回本地化单位
    public function getUnit()
    {
        return self::$currencies[$this->currencyCode]['unit'];
    }
    //返回本地化代码
    public function getLocal()
    {
        return self::$currencies[$this->currencyCode]['local'];
    }
    //返回默认保留的小数位
    public function getDefaultFractionDigits()
    {
        return self::$currencies[$this->currencyCode]['default_fraction_digits'];
    }

    //类字符串化，返回当前的币种代码
    public function __toString()
    {
        return $this->currencyCode;
    }

}