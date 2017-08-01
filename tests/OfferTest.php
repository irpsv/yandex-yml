<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Price;
use jugger\yandexYml\Outlet;
use jugger\yandexYml\Currency;
use jugger\yandexYml\Delivery;
use jugger\yandexYml\SimpleOffer;
use jugger\yandexYml\ArbitraryOffer;
use jugger\yandexYml\builders\SimpleOfferBuilder;
use jugger\yandexYml\builders\ArbitraryOfferBuilder;

class OfferTest extends TestCase
{
	public function testSimpleMinimal()
	{
		$builder = new SimpleOfferBuilder();
		$offer = new SimpleOffer(
			"id",
			"url",
			new Price(1000, true),
			Currency::ID_RUR,
			1,
			"Мороженица Brand 3811"
		);
		$this->assertEquals(
			'<offer id="id"><name>Мороженица Brand 3811</name><url>url</url><price from="true">1000</price><currencyId>RUR</currencyId><categoryId>1</categoryId></offer>',
			$builder->build($offer)
		);
	}

	public function testArbitraryMinimal()
	{
		$builder = new ArbitraryOfferBuilder();
		$offer = new ArbitraryOffer(
			"id",
			"url",
			new Price(1000, true),
			Currency::ID_RUR,
			1,
			"3811",
			"Brand"
		);
		$this->assertEquals(
			'<offer id="id" type="vendor.model"><model>3811</model><vendor>Brand</vendor><url>url</url><price from="true">1000</price><currencyId>RUR</currencyId><categoryId>1</categoryId></offer>',
			$builder->build($offer)
		);
	}

	public function testSimpleAllProps()
	{
		$builder = new SimpleOfferBuilder();
		$offer = new SimpleOffer(
			"id",
			"url",
			new Price(1000, true),
			Currency::ID_RUR,
			1,
			"Мороженица Brand 3811"
		);
		$offer->cbid = "654";
		$offer->bid = "123";
		$offer->fee = "54";
		$offer->url = "url";
		$offer->oldprice = new Price(5000);
		$offer->picture = "http://best.seller.ru/img/model_12345.jpg";
		$offer->addDelivery(
			new Delivery(123)
		);
		$offer->addDelivery(
			new Delivery(456, 7)
		);
		$offer->pickup = true;
		$offer->available = false;
		$offer->store = true;
		$offer->addOutlet(
			new Outlet(1, 20)
		);
		$offer->addOutlet(
			new Outlet(2, 30, true)
		);
		$offer->description = "<h3>Мороженица Brand 3811</h3><p>Это прибор, который придётся по вкусу всем любителям десертов и сладостей, ведь с его помощью вы сможете делать вкусное домашнее мороженое из натуральных ингредиентов.</p>";
		$offer->sales_notes = "Варианты оплаты и минимальная сумма заказа";
		$offer->minQuantity = 2;
		$offer->stepQuantity = 2;
		$offer->manufacturer_warranty = true;
		$offer->country_of_origin = "Россия";
		$offer->adult = true;
		$offer->age = 6;
		$offer->barcode = "0123456789379";
		$offer->cpa = 1;
		$offer->addParam(
			"Цвет", "белый"
		);
		$offer->addParam(
			"Вольтаж", "220", "вольт"
		);
		$offer->expiry = date(\DATE_ISO8601, 1501502078);
		$offer->weight = 1.234;
		$offer->dimensions = "1.23/4.56/789";
		$offer->downloadable = true;
		$offer->setRec([
			123, 456, 789
		]);

		$offer->model = "(VLNEO) V RACER NYLON";
		$offer->vendor = "Brand";
		$offer->vendorCode = "BB";

		$offerTestXml = file_get_contents(__DIR__.'/offer-test.xml');
		$offerTestXml = str_replace(["\n", "\r", "\n\r", "\r\n"], "", $offerTestXml);
		$this->assertEquals(
			$offerTestXml,
			$builder->build($offer)
		);
	}
}
