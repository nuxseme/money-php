<?php
/**
 * @link http://www.tomtop.com/
 * @copyright Copyright (c) 2016 TOMTOP
 * @license http://www.tomtop.com/license/
 */
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'money' => '/Money.php',
                'assert' => '/Assert.php',
                'currency' => '/Currency.php',
                'formatterabstract'=>'/format/FormatterAbstract.php',
                'formatterstrategysymbolvalue'=>'/format/FormatterStrategySymbolValue.php',
                'formatterstrategyvalueunit'=>'/format/FormatterStrategyValueUnit.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ .'/..'. $classes[$cn];
        }
    },
    true,
    false
);
$currency = new Currency('CNY');
$money = new Money(10890.99999,$currency);
$f = new FormatterStrategyValueUnit();
echo $f->format($money);