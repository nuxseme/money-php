<?php
namespace money;
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
class Money extends Assert
{
    //金额
    private $amount;
    //币种实例
    private $currency;

    public function __construct($amount,Currency $currency)
    {
        if (!is_numeric ($amount)) {
            throw new \Exception('$amount must be an numeric');
        }

        $this->amount   = $amount;
        $this->currency = $currency;
    }

    public function __toString()
    {
        return $this->amount;
    }

    //返回自身实例
    public function newMoney($amount){
        return new static($amount,$this->currency);
    }

    //传入金额字符串 返回money实例
    public static function fromString($value, $currency)
    {
        if (!is_string($value)) {
            throw new \Exception('$value must be a string');
        }
        return new static(floatval($value), $currency);
    }

    //返回当前金额
    public function getAmount()
    {
        return $this->amount;
    }
    //返回保留的小数位
    public function getConvertedAmount($fractionDigits = null)
    {
        return round($this->amount, $fractionDigits ?? $this->currency->getDefaultFractionDigits());
    }

    //返回货币实例
    public function getCurrency()
    {
        return $this->currency;
    }


    //返回打折后的价格
    public function extractPercentage($percentage)
    {
        return $this->newMoney($this->amount * $percentage);
    }

    //返回价格系数之后的价格
    public function multiply($factor)
    {
        return $this->newMoney($factor * $this->amount);
    }


    //价格加法
    public function add(Money $other)
    {
        $this->assertSameCurrency($this, $other);

        $value = $this->amount + $other->getAmount();

        return $this->newMoney($value);
    }

    //价格相减
    public function subtract(Money $other){

        $this->assertSameCurrency($this, $other);

        $value = $this->amount - $other->getAmount();

        return $this->newMoney($value);
    }

    //小于
    public function lessThan(Money $other){
        return $this->compareTo($other) == -1;
    }

    //小于等于
    public function lessThanOrEqual(Money $other){
        return $this->lessThan($other) || $this->equals($other);
    }

    //大于
    public function greaterThan(Money $other){
        return $this->compareTo($other) == 1;
    }

    //大于等于
    public function greaterThanOrEqual(Money $other){
        return $this->greaterThan($other) || $this->equals($other);
    }

    //等于
    public function equals(Money $other){
        return $this->compareTo($other) == 0;
    }

    //比较
    public function compareTo(Money $other)
    {
        $this->assertSameCurrency($this, $other);

        if ($this->amount == $other->getAmount()) {
            return 0;
        }

        return $this->amount < $other->getAmount() ? -1 : 1;
    }


}
