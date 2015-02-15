<?php

abstract class router_abstract
{
	protected $registry;
	public $action;
	public $controller;
	public $controller_path;
	public $model;
	public $model_path;
	public $ini_data;
	public $g_params;
	public $g_parts;
	public $mainTitle;
	public $script;
	public $view_path;

	public function __construct($registry)
	{
		$this->registry = $registry;
		self::get_ini_data();
		$this->view_path = self::get_view_path();
		$this->controller_path = self::get_controller_path();
		$this->model_path = self::get_model_path();
		self::get_params();
	}

	public function get_params()
	{
		if(empty($_GET['rt'])):
			$this->controller = 'index';
			$this->action = 'index';
			$this->g_params = null;
			$this->p_params = null;
			$this->s_params = null;
			$this->c_params = null;
		else:
			$this->g_parts = explode('/', $_GET['rt']);
			self::get_controller();
			self::get_model();
			self::get_action();
			self::get_g_params();
			self::get_script();
		endif;
	}

	public function get_controller()
	{
		if(!empty($this->g_parts[0])):
			$this->controller = $this->g_parts[0];
		else: $controller = 'index';
		endif;

		$this->model = $this->controller;

		return $this->controller;
	}

	public function get_model()
	{
		return $this->controller;
	}

	public function get_action()
	{
		if(!empty($this->g_parts[1])):
			$this->action = $this->g_parts[1];
		else: $this->action = 'index';
		endif;

		return $this->action;
	}

	public function get_g_params()
	{
		if(!empty($this->g_parts[0])):
			$this->controller = $this->g_parts[0];
		endif;

		if(!empty($this->g_parts[1])):
			$this->action = $this->g_parts[1];
		else: $this->action = 'index';
		endif;

		$ct = count($this->g_parts);

		for($i=2; $i<$ct; $i++):
			if(!($i%2) ? TRUE : FALSE):
				if(!empty($this->g_parts[$i+1])):
					$this->g_params[$this->g_parts[$i]] = $this->g_parts[$i+1];
				else: $this->g_params[$this->g_parts[$i]] = null;
				endif;
			endif;
		endfor;
	}

	public function return_action()
	{
		return $this->action;
	}

	public function get_script()
	{
		return $this->script;
	}

	public function get_view_path()
	{
		return $this->ini_data['include_paths']['application_path'].'view/';
	}

	public function get_controller_path()
	{
		return $this->ini_data['include_paths']['application_path'].'controller/';
	}

	public function get_model_path()
	{
		return $this->ini_data['include_paths']['application_path'].'model/'.$this->controller;
	}

	public function get_site_path()
	{
		return $this->ini_data['include_paths']['site_path'];
	}

	public function get_ini_data()
	{
		$this->ini_data = parse_ini_file('../application/config/paths.ini.php', true);
	}
}