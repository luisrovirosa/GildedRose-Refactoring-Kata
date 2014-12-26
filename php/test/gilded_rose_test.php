<?php

require_once 'gilded_rose.php';

class GildedRoseTest extends PHPUnit_Framework_TestCase {
    const NORMAL_PRODUCT = "foo";
    const SELL_IN_POSITIVE_DAYS = 10;

    /** @test  */
    function shouldDecreaseTheQualityWhenNormalProductHasValue() {
        $quality = 100;
        $items = array(new Item(self::NORMAL_PRODUCT, self::SELL_IN_POSITIVE_DAYS, $quality));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($quality-1, $items[0]->quality);
        $this->assertEquals(self::SELL_IN_POSITIVE_DAYS-1, $items[0]->sell_in);
        $this->assertEquals(self::NORMAL_PRODUCT, $items[0]->name);
    }
}
