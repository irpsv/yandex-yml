<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use jugger\yandexYml\Category;
use jugger\yandexYml\builders\CategoryBuilder;

class CategoryTest extends TestCase
{
	public function testConstruct()
	{
		$cat = new Category(1, "Книги");
		$builder = new CategoryBuilder();

		$this->assertEquals(
			$builder->build($cat),
			"<category id=\"1\">Книги</category>"
		);
	}

	public function testWithParent()
	{
		$builder = new CategoryBuilder();

		$cat = new Category(2, "Детективы", 1);
		$this->assertEquals(
			$builder->build($cat),
			"<category id=\"2\" parentId=\"1\">Детективы</category>"
		);

		$cat = new Category(3, "Боевики");
		$cat->parentId = 1;
		$this->assertEquals(
			$builder->build($cat),
			"<category id=\"3\" parentId=\"1\">Боевики</category>"
		);
	}
}
