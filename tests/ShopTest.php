<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Shop;
use jugger\yandexYml\builders\ShopBuilder;
use jugger\yandexYml\Category;
use jugger\yandexYml\Currency;
use jugger\yandexYml\SimpleOffer;
use jugger\yandexYml\Price;
use jugger\yandexYml\Delivery;


class ShopTest extends TestCase
{
    public function testConstruct()
    {
		$shop = new Shop("My test shop", "My company", "My url");
		$builder = new ShopBuilder();
		$this->assertEquals(
			$builder->build($shop),
			"<shop><name>My test shop</name><company>My company</company><url>My url</url></shop>"
		);
    }

	public function testProperties()
    {
		$shop = new Shop("My test shop", "", "");
		$shop->url = "url";
		$shop->cpa = true;
		$shop->email = "email";
		$shop->agency = [["what?!"]];
		$shop->version = "version";
		$shop->company = "company";
		$shop->platform = "platform";

		$shop->email = "email";
		$builder = new ShopBuilder();
		$this->assertEquals(
			$builder->build($shop),
			"<shop><name>My test shop</name><company>company</company><url>url</url><platform>platform</platform><version>version</version><agency/><email>email</email><cpa>1</cpa></shop>"
		);
    }

	public function testCurrency()
    {
		$shop = new Shop("My test shop", "My company", "My url");
		$shop->addCurrency(
			new Currency("RUR", 1)
		);
		$shop->addCurrency(
			new Currency(Currency::ID_USD, 60)
		);

		$this->assertEquals(
			(new ShopBuilder)->build($shop),
			'<shop><name>My test shop</name><company>My company</company><url>My url</url><currencies><currency id="RUR" rate="1"/><currency id="USD" rate="60"/></currencies></shop>'
		);
    }

	public function testCategory()
    {
		$shop = new Shop("My test shop", "My company", "My url");
		$shop->addCategory(
			new Category(1, "Бытовая техника")
		);
		$shop->addCategory(
			new Category(10, "Мелкая техника для кухни", 1)
		);

		$this->assertEquals(
			(new ShopBuilder)->build($shop),
			'<shop><name>My test shop</name><company>My company</company><url>My url</url><categories><category id="1">Бытовая техника</category><category id="10" parentId="1">Мелкая техника для кухни</category></categories></shop>'
		);
    }

	public function testDelivaries()
    {
		$shop = new Shop("My test shop", "My company", "My url");
		$shop->addDelivery(
			new Delivery(123)
		);
		$shop->addDelivery(
			new Delivery(456, 7)
		);

		$this->assertEquals(
			(new ShopBuilder)->build($shop),
			'<shop><name>My test shop</name><company>My company</company><url>My url</url><delivery-options><option cost="123"/><option cost="456" days="7"/></delivery-options></shop>'
		);
    }

	public function testOffers()
    {
		$shop = new Shop("My test shop", "My company", "My url");
		$shop->addOffer(
			new SimpleOffer(
				1,
				"http://best.seller.ru/product_page.asp?pid=12348",
				new Price(100),
				Currency::ID_RUR,
				101,
				"Вафельница First"
			)
		);
		$shop->addOffer(
			new SimpleOffer(
				2,
				"http://best.seller.ru/product_page.asp?pid=12348",
				new Price(200),
				Currency::ID_RUR,
				101,
				"Пельменница Second"
			)
		);

		$this->assertEquals(
			(new ShopBuilder)->build($shop),
			'<shop><name>My test shop</name><company>My company</company><url>My url</url><offers><offer id="1"><name>Вафельница First</name><url>http://best.seller.ru/product_page.asp?pid=12348</url><price>100</price><currencyId>RUR</currencyId><categoryId>101</categoryId></offer><offer id="2"><name>Пельменница Second</name><url>http://best.seller.ru/product_page.asp?pid=12348</url><price>200</price><currencyId>RUR</currencyId><categoryId>101</categoryId></offer></offers></shop>'
		);
    }
}
