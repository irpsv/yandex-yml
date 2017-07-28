<?php

namespace jugger\yandexYml;

class Category
{
	public $id;
	public $name;
	public $parentId;

	public function __construct(int $id, string $name, int $parentId = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->parentId = $parentId;
	}
}
