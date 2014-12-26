<?php

require_once 'gilded_rose.php';

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

    const NORMAL_PRODUCT = "foo";
    const SELL_IN_POSITIVE_DAYS = 10;
    const SELL_IN_EXPIRED_DATE = -10;
    const NORMAL_QUALITY = 100;

    /** @test  */
    function shouldDecreaseTheQualityBy1WhenNormalProductHasValue()
    {
        $items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_POSITIVE_DAYS, self::NORMAL_QUALITY));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals(self::NORMAL_QUALITY - 1, $items[0]->quality);
        $this->assertEquals(self::SELL_IN_POSITIVE_DAYS - 1, $items[0]->sell_in);
        $this->assertEquals(self::NORMAL_PRODUCT, $items[0]->name);
    }

    /** @test */
    public function shouldDecreaseTheQualityBy2WhenNormalProductHasValueAndIsNotExpired()
    {
        $items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_EXPIRED_DATE, self::NORMAL_QUALITY));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals(self::NORMAL_QUALITY - 2, $items[0]->quality);
        $this->assertEquals(self::SELL_IN_EXPIRED_DATE - 1, $items[0]->sell_in);
        $this->assertEquals(self::NORMAL_PRODUCT, $items[0]->name);
    }

}
