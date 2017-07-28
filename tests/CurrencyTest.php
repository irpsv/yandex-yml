<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Currency;
use jugger\yandexYml\builders\CurrencyBuilder;

class CurrencyTest extends TestCase
{
	public function testConstruct()
	{
		$cur = new Currency("RUR", 1);
		$builder = new CurrencyBuilder();
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"1\"/>"
		);

		$cur->rate = 123;
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"123\"/>"
		);
	}

	public function testConstantId()
	{
		$builder = new CurrencyBuilder();

		$cur = new Currency(Currency::ID_RUR);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"CB\"/>"
		);

		$cur = new Currency(Currency::ID_USD);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"USD\" rate=\"CB\"/>"
		);

		$cur = new Currency(Currency::ID_EUR);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"EUR\" rate=\"CB\"/>"
		);

		$cur = new Currency(Currency::ID_UAH);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"UAH\" rate=\"CB\"/>"
		);

		$cur = new Currency(Currency::ID_KZT);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"KZT\" rate=\"CB\"/>"
		);
	}

	public function testConstantRate()
	{
		$builder = new CurrencyBuilder();

		$cur = new Currency('RUR', Currency::RATE_RU);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"CBRF\"/>"
		);

		$cur = new Currency('RUR', Currency::RATE_UA);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"NBU\"/>"
		);

		$cur = new Currency('RUR', Currency::RATE_KZ);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"NBK\"/>"
		);

		$cur = new Currency('RUR', Currency::RATE_CB);
		$this->assertEquals(
			$builder->build($cur),
			"<currency id=\"RUR\" rate=\"CB\"/>"
		);
	}
}
