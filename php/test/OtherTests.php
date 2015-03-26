<?php


namespace LuisRovirosa\GildedRose\Test;

class OtherTests extends GildedRoseTest
{
    private $item;
    private $expectedQuality;
    private $expectedDate;
    private $expectedProductName;

    protected function setUp()
    {
        $this->expectedQuality = self::QUALITY_NORMAL - 1;
        $this->expectedDate = self::SELL_IN_POSITIVE_DAYS - 1;
        $this->expectedProductName = self::PRODUCT_NORMAL;
    }


//    /** @test */
//    public function shouldNotHaveMoreQualityThan50()
//    {
//        $this->item = new Item(self::PRODUCT_NORMAL, self::SELL_IN_POSITIVE_DAYS, self::MAXIMUM_QUALITY * 99);
//        $this->expectedQuality = self::MAXIMUM_QUALITY - 1;
//    }

    /** @test */
    public function shouldIncreaseTheQualityOfBackstageWhenMoreThan10Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_MORE_THAN_10_DAYS, self::QUALITY_NORMAL);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_NORMAL + 1;
        $this->expectedDate = self::SELL_IN_MORE_THAN_10_DAYS - 1;
    }

    /** @test */
    public function shouldIncreaseTheQualityBy2OfBackstageWhen10Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_POSITIVE_DAYS, self::QUALITY_NORMAL);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_NORMAL + 2;
    }

    /** @test */
    public function shouldIncreaseTheQualityBy3OfBackstageWhen5Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_5_DAYS, self::QUALITY_NORMAL);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_NORMAL + 3;
        $this->expectedDate = self::SELL_IN_5_DAYS - 1;
    }

    /** @test */
    public function shouldBe0TheQualityByOfBackstageWhen0Days()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_0_DAYS, self::QUALITY_NORMAL);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_ZERO;
        $this->expectedDate = self::SELL_IN_0_DAYS - 1;
    }

    //----------------------------

    /** @test */
    public function shouldNotIncreaseTheQualityOfBackstageWhenMoreThan10DaysAndTheQualityIs50()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_MORE_THAN_10_DAYS, self::QUALITY_MAXIMUM);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_MAXIMUM;
        $this->expectedDate = self::SELL_IN_MORE_THAN_10_DAYS - 1;
    }

    /** @test */
    public function shouldNotIncreaseTheQualityOfBackstageWhen10DaysAndTheQualityIs50()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_POSITIVE_DAYS, self::QUALITY_MAXIMUM);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_MAXIMUM;
    }

    /** @test */
    public function shouldNotIncreaseTheQualityOfBackstageWhen5DaysAndTheQualityIs50()
    {
        $this->item = new Item(self::PRODUCT_BACKSTAGE, self::SELL_IN_5_DAYS, self::QUALITY_MAXIMUM);
        $this->expectedProductName = self::PRODUCT_BACKSTAGE;
        $this->expectedQuality = self::QUALITY_MAXIMUM;
        $this->expectedDate = self::SELL_IN_5_DAYS - 1;
    }

    protected function tearDown()
    {
        $gildedRose = new GildedRose(array($this->item));
        $gildedRose->update_quality();
        $this->assertEquals($this->expectedQuality, $this->item->quality, 'Expected quality');
        $this->assertEquals($this->expectedDate, $this->item->sell_in, 'Expected date');
        $this->assertEquals($this->expectedProductName, $this->item->name, 'Expected product name');
    }
}
