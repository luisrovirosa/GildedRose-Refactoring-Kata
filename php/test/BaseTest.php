<?php

namespace LuisRovirosa\GildedRose\Test;

use LuisRovirosa\GildedRose\Item;
use LuisRovirosa\GildedRose\GildedRose;

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{

    const PRODUCT_NORMAL = "foo";
    const PRODUCT_AGED_BRIE = "Aged Brie";
    const PRODUCT_SULFURAS = "Sulfuras, Hand of Ragnaros";
    const PRODUCT_BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";
    const SELL_IN_POSITIVE_DAYS = 10;
    const SELL_IN_MORE_THAN_10_DAYS = 20;
    const SELL_IN_5_DAYS = 5;
    const SELL_IN_0_DAYS = 0;
    const SELL_IN_EXPIRED_DATE = -10;
    const QUALITY_NORMAL = 10;
    const QUALITY_MAXIMUM = 50;
    const QUALITY_ZERO = 0;

    public function possibleDays()
    {
        return array(
            array(BaseTest::SELL_IN_EXPIRED_DATE),
            array(BaseTest::SELL_IN_POSITIVE_DAYS),
            array(BaseTest::SELL_IN_0_DAYS),
        );
    }

    public function possibleQualities()
    {
        return array(
            array(BaseTest::QUALITY_NORMAL),
            array(BaseTest::QUALITY_ZERO),
            array(BaseTest::QUALITY_MAXIMUM),
        );
    }

    /**
     * @param $name
     * @param $days
     * @param $quality
     * @return Item
     */
    protected function createProduct($name, $days, $quality)
    {
        $this->item = new Item($name, $days, $quality);
    }

    protected function nextDay()
    {
        $gildedRose = new GildedRose(array($this->item));
        $gildedRose->update_quality();
    }

    /**
     * @param $expectedQuality
     * @param $message
     */
    protected function assertQuality($expectedQuality, $message)
    {
        $this->assertEquals($expectedQuality, $this->item->quality, $message);
    }

    /**
     * @param $expectedDays
     * @param $message
     */
    protected function assertExpectedDays($expectedDays, $message)
    {
        $this->assertEquals($expectedDays, $this->item->sell_in, $message);
    }
}
