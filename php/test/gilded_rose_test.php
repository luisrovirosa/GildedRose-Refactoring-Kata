<?php

require_once 'gilded_rose.php';

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

    const NORMAL_PRODUCT = "foo";
    const SELL_IN_POSITIVE_DAYS = 10;
    const SELL_IN_EXPIRED_DATE = -10;
    const NORMAL_QUALITY = 100;
    const ZERO_QUALITY = 0;

    private $items;
    private $expectedQuality;
    private $expectedDate;
    private $expectedProductName;

    protected function setUp()
    {
        $this->expectedQuality = self::NORMAL_QUALITY - 1;
        $this->expectedDate = self::SELL_IN_POSITIVE_DAYS - 1;
        $this->expectedProductName = self::NORMAL_PRODUCT;
    }

    /** @test  */
    function shouldDecreaseTheQualityBy1WhenNormalProductHasValue()
    {
        $this->items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_POSITIVE_DAYS, self::NORMAL_QUALITY));
    }

    /** @test */
    public function shouldDecreaseTheQualityBy2WhenNormalProductHasValueAndIsNotExpired()
    {
        $this->items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_EXPIRED_DATE, self::NORMAL_QUALITY));
        $this->expectedQuality = self::NORMAL_QUALITY - 2;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE - 1;
    }

    /** @test */
    public function shouldBe0WhenTheQualityIs0()
    {
        $this->items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_POSITIVE_DAYS, self::ZERO_QUALITY));
        $this->expectedQuality = self::ZERO_QUALITY;
    }

    /** @test */
    public function shouldBe0WhenTheQualityIs0EvenIfIsExpired()
    {
        $this->items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_EXPIRED_DATE, self::ZERO_QUALITY));
        $this->expectedQuality = self::ZERO_QUALITY;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE - 1;
    }

    protected function tearDown()
    {
        $gildedRose = new GildedRose($this->items);
        $gildedRose->update_quality();
        $item = $this->items[0];
        $this->assertEquals($this->expectedQuality, $item->quality);
        $this->assertEquals($this->expectedDate, $item->sell_in);
        $this->assertEquals($this->expectedProductName, $item->name);
    }

}
