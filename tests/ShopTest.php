<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Shop;
use jugger\yandexYml\builders\ShopBuilder;

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
		$shop->email = "email";
		$shop->agency = [["what?!"]];
		$shop->version = "version";
		$shop->company = "company";
		$shop->platform = "platform";

		$shop->email = "email";
		$builder = new ShopBuilder();
		$this->assertEquals(
			$builder->build($shop),
			"<shop><name>My test shop</name><company>company</company><url>url</url><platform>platform</platform><version>version</version><agency/><email>email</email></shop>"
		);
    }
}
