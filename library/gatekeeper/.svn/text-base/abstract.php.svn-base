<?php

abstract class gatekeeper_abstract
{
	protected $registry;
	public $ini_data;
	private $vars = array();
	public $usertype;
	public $validation = array();

	public function __construct($registry)
	{
		$this->registry = $registry;
		$this->ini_data = parse_ini_file('../application/config/gatekeeper.ini.php', true);
		$this->check_permissions();
	}

	public function __set($index, $value)
 	{
		$this->vars[$index] = $value;
	}

 	public function __get($index)
 	{
		return $this->vars[$index];
	}

	public function check_permissions()
	{
		if(!empty($_SESSION['user'])):
			$this->usertype = $_SESSION['user']['usertype'];
		else: $this->usertype = 'guest';
		endif;

		$domain = $this->registry->router->controller.'.'.$this->registry->router->action.'.'.$this->usertype;

		if(!empty($this->ini_data['rules'][$domain])):
			if($this->ini_data['rules'][$domain] == 'deny'):
				$directive = explode('.', $this->ini_data['actions'][$domain]);
				$activity = $directive[0];
				$controller = $directive[1];
				$action = $directive[2];
				if($activity == 'redirect'):
					$this->registry->navigator->redirect(array('url'=>'error/accessdenied'));
				endif;
			endif;
		else: $this->registry->navigator->redirect(array('url'=>'error/pagenotfound'));
		endif;
	}

	public function validation($args)
	{
		array_push($this->validation, $args);
	}
}