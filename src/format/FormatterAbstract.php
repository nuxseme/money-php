<?php

namespace money\format;
use money\Money;

/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */

abstract class FormatterAbstract
{
    abstract public function format(Money $money);
}