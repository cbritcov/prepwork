<?php

abstract class session_abstract
{
	public $vars = array();
	protected $registry;

	public function __construct($registry)
	{
		$this->registry = $registry;
		self::save();
	}

	public function save()
	{
		foreach($_SESSION as $session=>$key):
			$this->data[$session] = $key;
		endforeach;
	}

	public function set($options)
	{
		if(empty($options['name'])):
			throw new gException(get_class($this).' requires a name to be set');
		endif;

		if(empty($options['value'])):
			throw new gException(get_class($this).' requires a value to be set');
		endif;

		if(!empty($options['key'])):
			$key = $options['key'];
		else: $key = null;
		endif;

		$_SESSION[$key][$options['name']] = $options['value'];
	}

	public function destroy($name)
	{
		unset($_SESSION[$name]);
	}
}