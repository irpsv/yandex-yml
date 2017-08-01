<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Shop;
use jugger\yandexYml\Category;
use jugger\yandexYml\Currency;
use jugger\yandexYml\SimpleOffer;
use jugger\yandexYml\Price;
use jugger\yandexYml\Delivery;
use jugger\yandexYml\builders\CatalogBuilder;

class GeneralTest extends TestCase
{
	public function testMain()
	{
		$shop = new Shop("BestSeller", "Tne Best inc.", "http://best.seller.ru");
		// currency
		$shop->addCurrency(
			new Currency("RUR", 1)
		);
		$shop->addCurrency(
			new Currency(Currency::ID_USD, 60)
		);
		// category
		$shop->addCategory(
			new Category(1, "Бытовая техника")
		);
		$shop->addCategory(
			new Category(10, "Мелкая техника для кухни", 1)
		);
		$shop->addCategory(
			new Category(101, "Сэндвичницы и приборы для выпечки", 10)
		);
		$shop->addCategory(
			new Category(102, "Мороженицы", 10)
		);
		// offers
		$offer = new SimpleOffer(
			12346,
			"http://best.seller.ru/product_page.asp?pid=12348",
			new Price(1490),
			Currency::ID_RUR,
			101,
			"Вафельница First FA-5300"
		);
		$offer->available = true;
		$offer->bid = 80;
		$offer->cbid = 90;
		$offer->fee = 325;
        $offer->oldprice = 1620;
        $offer->picture = "http://best.seller.ru/img/large_12348.jpg";
		$offer->store = false;
        $offer->pickup = true;
		$offer->addDelivery(
			new Delivery(300, 0, 12)
		);
		$offer->vendor = "First";
		$offer->vendorCode = "A1234567B";
        $offer->sales_notes = "Необходима предоплата.";
        $offer->manufacturer_warranty = true;
        $offer->country_of_origin = "Россия";
        $offer->barcode = "0156789012";
        $offer->cpa = 1;
        $offer->setRec([
			123,456
		]);
		$shop->addOffer($offer);
		// build
		$builder = new CatalogBuilder;
		$offerTestXml = str_replace(
			["\n", "\r", "\n\r", "\r\n"],
			"",
			file_get_contents(__DIR__.'/general-test.xml')
		);
		$this->assertEquals(
			$offerTestXml,
			str_replace(
				["\n", "\r", "\n\r", "\r\n"],
				"",
				$builder->build($shop, "2017-02-05 17:22")
			)
		);
	}
}
