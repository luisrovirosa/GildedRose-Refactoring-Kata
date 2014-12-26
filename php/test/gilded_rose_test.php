<?php

require_once 'gilded_rose.php';

class GildedRoseTest extends PHPUnit_Framework_TestCase {

    /** @test  */
    function shouldDecreaseTheQualityWhenNormalProductHasValue() {
        $quality = 100;
        $items = array(new Item("foo", 10, $quality));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($quality-1, $items[0]->quality);
    }

}
