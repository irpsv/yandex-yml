<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Shop;
use jugger\yandexYml\builders\ShopBuilder;

class ShopTest extends TestCase
{
    public function testConstruct()
    {
		$shop = new Shop("My test shop");
		$builder = new ShopBuilder($shop);
		$this->assertEquals(
			$builder->build(),
			"<shop><name>My test shop</name><company/><url/></shop>"
		);
    }

	public function testProperties()
    {
		$shop = new Shop("My test shop");
		$shop->url = "url";
		$shop->email = "email";
		$shop->agency = [["what?!"]];
		$shop->version = "version";
		$shop->company = "company";
		$shop->platform = "platform";

		$shop->email = "email";
		$builder = new ShopBuilder($shop);
		$this->assertEquals(
			$builder->build(),
			"<shop><name>My test shop</name><company>company</company><url>url</url><platform>platform</platform><version>version</version><agency/><email>email</email></shop>"
		);
    }
}
