<?php
use PHPUnit\Framework\TestCase;
use money\Money;
use money\Currency;
use money\format\FormatterStrategyValueUnit;
use money\format\FormatterStrategySymbolValue;
class MoneyTest extends TestCase
{
    public function testInstanceMoney()
    {
        $money = new Money(100);
        $this->assertInstanceOf(Money::class, $money);

        $currency = new Currency('USD');
        $money = new Money(100, $currency);
        $this->assertInstanceOf(Money::class, $money);
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage  currency must instance of Currency
     */
    public function testInstanceMoneyException()
    {
        new Money(100, 'CNY');
    }

    public function testGetAmount()
    {
        $money = new Money(100);
        $this->assertEquals(100, $money->getAmount());
    }

    public function testNewMoney()
    {
        $money = new Money(100.5);
        $newMoney = $money->newMoney(100.3);
        $this->assertInstanceOf(Money::class, $newMoney);
    }

    public function testFromString()
    {
        $money = new Money(100);
        $newMoney = $money::fromString('100.34');
        $this->assertEquals(100.34, $newMoney->getAmount());
    }

    public function testGetFormatByStrategy()
    {
        $format = new FormatterStrategyValueUnit(2);
        $this->assertEquals($format->format(new Money(100)), '100.00元');
        $format = new FormatterStrategySymbolValue(2);
        $this->assertEquals($format->format(new Money(100.1234, new Currency('EUR'))), '€100.12');
    }
}