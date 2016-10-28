<?php
namespace money;

/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
class Assert
{
    //浮点数断言
    public function assertIsFloat($var){

        if(!is_float($var))
        {
            throw new \Exception('$var must be float type');
        }
    }

    //整数断言
    public function assertIsInteger($var){
        if(!is_int($var))
        {
            throw new \Exception('$var must be int type');
        }
    }
    //空 断言
    public function asserIsEmpty($var){
        if(!empty($var))
        {
            throw new \Exception('$var must be empty');
        }
    }
    //零 断言
    public  function  assertIsZero($var){
        if(!$var === 0)
        {
            throw new \Exception('$var is not zero');
        }
    }

    public function assertSameCurrency(Money $a, Money $b)
    {
        if ($a->getCurrency() != $b->getCurrency()) {
            throw new \Exception('currency is not same');
        }
    }

}