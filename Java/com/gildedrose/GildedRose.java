package com.gildedrose;

class GildedRose {
	private static final String AGED_BRIE_NAME = "Aged Brie";
	private static final String BACKSTAGE_NAME = "Backstage passes to a TAFKAL80ETC concert";
	Item[] items;

	public GildedRose(Item[] items) {
		this.items = items;
	}

	public void updateQuality() {
		for (int i = 0; i < items.length; i++) {
			update(items[i]);
		}
	}

	private void update(Item item) {
		if (!isAgedBrie(item) && !item.name.equals(BACKSTAGE_NAME)) {
			if (item.quality > 0) {
				if (!item.name.equals("Sulfuras, Hand of Ragnaros")) {
					item.quality = item.quality - 1;
				}
			}
		} else {
			if (item.quality < 50) {
				item.quality = item.quality + 1;

				if (item.name.equals(BACKSTAGE_NAME)) {
					if (item.sellIn < 11) {
						if (item.quality < 50) {
							item.quality = item.quality + 1;
						}
					}

					if (item.sellIn < 6) {
						if (item.quality < 50) {
							item.quality = item.quality + 1;
						}
					}
				}
			}
		}

		if (!item.name.equals("Sulfuras, Hand of Ragnaros")) {
			item.sellIn = item.sellIn - 1;
		}

		if (item.sellIn < 0) {
			if (!isAgedBrie(item)) {
				if (!item.name.equals(BACKSTAGE_NAME)) {
					if (item.quality > 0) {
						if (!item.name.equals("Sulfuras, Hand of Ragnaros")) {
							item.quality = item.quality - 1;
						}
					}
				} else {
					item.quality = item.quality - item.quality;
				}
			} else {
				if (item.quality < 50) {
					item.quality = item.quality + 1;
				}
			}
		}
	}

	private boolean isAgedBrie(Item item) {
		return item.name.equals(AGED_BRIE_NAME);
	}
}
