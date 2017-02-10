<?php
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'money\\money' => '/src/Money.php',
                'money\\currency' => '/src/Currency.php',
                'money\\assert' => '/src/Assert.php',
                'money\\format\\formatterabstract' => '/src/format/FormatterAbstract.php',
                'money\\format\\formatterstrategysymbolvalue' => '/src/format/FormatterStrategySymbolValue.php',
                'money\\format\\formatterstrategyvalueunit' => '/src/format/FormatterStrategyValueUnit.php',
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


$money = new money\Money(100);
echo $money->getAmount();//100

$format = new \money\format\FormatterStrategyValueUnit(2);
echo $format->format($money);//100.00元

echo $format->format(new \money\Money(100.1234, new \money\Currency('USD')));//100.12$