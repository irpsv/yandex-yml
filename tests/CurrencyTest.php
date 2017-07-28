<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Currency;

class CurrencyTest extends TestCase
{
	public function testConstruct()
	{
		$cur = new Currency("RUR", 1);
		$builder = new CurrencyBuilder();
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate='1' />"
		);

		$this->assertEquals(
			$builder->build(),
			"<currency id=\"RUR\" rate='1' />"
		);
	}

	public function testConstant()
	{

	}
}
