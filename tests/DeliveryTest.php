<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Delivery;
use jugger\yandexYml\builders\DeliveryBuilder;

class DeliveryTest extends TestCase
{
	public function testConstruct()
	{
		$builder = new DeliveryBuilder();

		$cat = new Delivery(123);
		$this->assertEquals(
			$builder->build($cat),
			"<option cost=\"123\"/>"
		);

		$cat = new Delivery(0, 5);
		$this->assertEquals(
			$builder->build($cat),
			"<option cost=\"0\" days=\"5\"/>"
		);

		$cat = new Delivery(0, "2-4", 18);
		$this->assertEquals(
			$builder->build($cat),
			"<option cost=\"0\" days=\"2-4\" order-before=\"18\"/>"
		);
	}

	public function testProperty()
	{
		$builder = new DeliveryBuilder();

		$cat = new Delivery(0);
		$this->assertEquals(
			$builder->build($cat),
			"<option cost=\"0\"/>"
		);

		$cat->days = 5;
		$this->assertEquals(
			$builder->build($cat),
			"<option cost=\"0\" days=\"5\"/>"
		);

		$cat->orderBefore = 18;
		$this->assertEquals(
			$builder->build($cat),
			"<option cost=\"0\" days=\"5\" order-before=\"18\"/>"
		);
	}
}
