<?php

abstract class navigator_abstract
{
	protected $registry;

	public function __construct($registry)
	{
		$this->registry = $registry;
	}
}