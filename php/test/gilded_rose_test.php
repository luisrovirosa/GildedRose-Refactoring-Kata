<?php

require_once 'gilded_rose.php';

class GildedRoseTest extends PHPUnit_Framework_TestCase
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
    const NORMAL_QUALITY = 10;
    const MAXIMUM_QUALITY = 50;
    const ZERO_QUALITY = 0;

    private $item;
    private $expectedQuality;
    private $expectedDate;
    private $expectedProductName;

    protected function setUp()
    {
        $this->expectedQuality = self::NORMAL_QUALITY - 1;
        $this->expectedDate = self::SELL_IN_POSITIVE_DAYS - 1;
        $this->expectedProductName = self::PRODUCT_NORMAL;
    }

    /** @test  */
    function shouldDecreaseTheQualityBy1WhenNormalProductHasValue()
    {
        $this->item = new Item(self::PRODUCT_NORMAL, self::SELL_IN_POSITIVE_DAYS, self::NORMAL_QUALITY);
    }

    /** @test */
    public function shouldDecreaseTheQualityBy2WhenNormalProductHasValueAndIsNotExpired()
    {
        $this->item = new Item(self::PRODUCT_NORMAL, self::SELL_IN_EXPIRED_DATE, self::NORMAL_QUALITY);
        $this->expectedQuality = self::NORMAL_QUALITY - 2;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE - 1;
    }

    /** @test */
    public function shouldBe0WhenTheQualityIs0()
    {
        $this->item = new Item(self::PRODUCT_NORMAL, self::SELL_IN_POSITIVE_DAYS, self::ZERO_QUALITY);
        $this->expectedQuality = self::ZERO_QUALITY;
    }

    /** @test */
    public function shouldBe0WhenTheQualityIs0EvenIfIsExpired()
    {
        $this->item = new Item(self::PRODUCT_NORMAL, self::SELL_IN_EXPIRED_DATE, self::ZERO_QUALITY);
        $this->expectedQuality = self::ZERO_QUALITY;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE - 1;
    }

    /** @test */
    public function shouldIncreaseTheQualityThenTheProductIsAgedBrie()
    {
        $this->item = new Item(self::PRODUCT_AGED_BRIE, self::SELL_IN_POSITIVE_DAYS, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_AGED_BRIE;
        $this->expectedQuality = self::NORMAL_QUALITY + 1;
    }

    /** @test */
    public function shouldIncreaseTheQualityBy2ThenTheProductIsAgedBrieAndIsExpired()
    {
        $this->item = new Item(self::PRODUCT_AGED_BRIE, self::SELL_IN_EXPIRED_DATE, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_AGED_BRIE;
        $this->expectedQuality = self::NORMAL_QUALITY + 2;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE - 1;
    }

    /** @test */
    public function shouldNotIncreaseTheQualityWhenGetsTheMaximum()
    {
        $this->item = new Item(self::PRODUCT_AGED_BRIE, self::SELL_IN_POSITIVE_DAYS, self::MAXIMUM_QUALITY);
        $this->expectedProductName = self::PRODUCT_AGED_BRIE;
        $this->expectedQuality = self::MAXIMUM_QUALITY;
    }

    /** @test */
    public function shouldNotIncreaseTheQualityWhenGetsTheMaximumAndIsExpired()
    {
        $this->item = new Item(self::PRODUCT_AGED_BRIE, self::SELL_IN_EXPIRED_DATE, self::MAXIMUM_QUALITY);
        $this->expectedProductName = self::PRODUCT_AGED_BRIE;
        $this->expectedQuality = self::MAXIMUM_QUALITY;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE - 1;
    }

//    /** @test */
//    public function shouldNotHaveMoreQualityThan50()
//    {
//        $this->item = new Item(self::PRODUCT_NORMAL, self::SELL_IN_POSITIVE_DAYS, self::MAXIMUM_QUALITY * 99);
//        $this->expectedQuality = self::MAXIMUM_QUALITY - 1;
//    }

    /** @test */
    public function shouldNotChangeTheExpectedDateInSulfuras()
    {
        $this->item = new Item(self::PRODUCT_SULFURAS, self::SELL_IN_POSITIVE_DAYS, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_SULFURAS;
        $this->expectedQuality = self::NORMAL_QUALITY;
        $this->expectedDate = self::SELL_IN_POSITIVE_DAYS;
    }

    /** @test */
    public function shouldNotChangeTheExpectedDateInSulfurasInExpiredDate()
    {
        $this->item = new Item(self::PRODUCT_SULFURAS, self::SELL_IN_EXPIRED_DATE, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_SULFURAS;
        $this->expectedQuality = self::NORMAL_QUALITY;
        $this->expectedDate = self::SELL_IN_EXPIRED_DATE;
    }

    /** @test */
    public function shouldIncreaseTheQualityOfBackstageWhenMoreThan10Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_MORE_THAN_10_DAYS, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::NORMAL_QUALITY + 1;
        $this->expectedDate = self::SELL_IN_MORE_THAN_10_DAYS - 1;
    }

    /** @test */
    public function shouldIncreaseTheQualityBy2OfBackstageWhen10Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_POSITIVE_DAYS, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::NORMAL_QUALITY + 2;
    }

    /** @test */
    public function shouldIncreaseTheQualityBy3OfBackstageWhen5Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_5_DAYS, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::NORMAL_QUALITY + 3;
        $this->expectedDate = self::SELL_IN_5_DAYS - 1;
    }

    /** @test */
    public function shouldBe0TheQualityByOfBackstageWhen0Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_0_DAYS, self::NORMAL_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::ZERO_QUALITY;
        $this->expectedDate = self::SELL_IN_0_DAYS - 1;
    }

    //----------------------------

    /** @test */
    public function shouldNotIncreaseTheQualityOfBackstageWhenMoreThan10DaysAndTheQualityIs50()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_MORE_THAN_10_DAYS, self::MAXIMUM_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::MAXIMUM_QUALITY;
        $this->expectedDate = self::SELL_IN_MORE_THAN_10_DAYS - 1;
    }

    /** @test */
    public function shouldNotIncreaseTheQualityOfBackstageWhen10DaysAndTheQualityIs50()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_POSITIVE_DAYS, self::MAXIMUM_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::MAXIMUM_QUALITY;
    }

    /** @test */
    public function shouldNotIncreaseTheQualityOfBackstageWhen5DaysAndTheQualityIs50()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_5_DAYS, self::MAXIMUM_QUALITY);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::MAXIMUM_QUALITY;
        $this->expectedDate = self::SELL_IN_5_DAYS - 1;
    }

    protected function tearDown()
    {
        $gildedRose = new GildedRose(array($this->item));
        $gildedRose->update_quality();
        $this->assertEquals($this->expectedQuality, $this->item->quality);
        $this->assertEquals($this->expectedDate, $this->item->sell_in);
        $this->assertEquals($this->expectedProductName, $this->item->name);
    }

}
