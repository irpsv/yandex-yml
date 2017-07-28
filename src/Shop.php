<?php

namespace jugger\yandexYml;

class Shop
{
	public $name;
	public $company;
	public $url;
	public $platform;
	public $version;
	public $agency;
	public $email;

	public function __construct(string $name)
	{
		$this->name = $name;
	}
}
