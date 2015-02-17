<?php

abstract class controller_abstract
{
	protected $registry;
	public $content;
	public $script;
	public $layout;

	public function __construct($registry)
	{
		$this->registry = $registry;
	}

	abstract function indexAction();

	public function __set($index, $value)
 	{
		$this->content[$index] = $value;
	}

 	public function __get($index)
 	{
		return $this->content[$index];
	}

	public function view()
	{
		$this->build_breadcrumbs($this->content['mainTitle']);

		foreach ($this->content as $key => $value):
			$$key = $value;
		endforeach;

		if(empty($this->layout)):
			$this->layout = 'main';
		endif;

		$script = $this->registry->script;

		include '../application/view/layout/'.$this->layout.'.phtml';
	}

	public function getContent()
	{
		return $this->content;
	}

	public function build_breadcrumbs($main_title)
	{
		$path = $this->registry->router->ini_data['site_path']['site_path'];
		$controller = $this->registry->router->controller.'/';
		$action = $this->registry->router->action.'/';
		$g_params = $this->registry->router->g_params;
		$params = null;

		if(!empty($g_params) && $g_params != 'Array'):
			foreach($g_params as $param=>$key):
				if(!empty($param)):
					$param = $param.'/';
				endif;
				if(!empty($key)):
					$key = $key.'/';
				endif;
				$params .= $param.$key;
			endforeach;
		endif;

		$current_url = '/'.$controller.$action.$params;

		$this_crumb = array(
			'url' => $current_url,
			'title' => $main_title
		);

		self::set_breadcrumb($this_crumb['url'], $this_crumb['title']);
	}

	public function set_breadcrumb($nav, $page)
	{
		if(empty($_SESSION['bc'])):
			$_SESSION['bc'] = array();
		endif;

		$next_breadcrumb = array(
			'name' => $page,
			'url' => $nav
		);

		$cnt = count($_SESSION['bc']);

		if(empty($_SESSION['bc'])):
			$_SESSION['bc'][0]['url'] = $nav;
			$_SESSION['bc'][0]['name'] = $page;
		else:
			if($_SESSION['bc'][$cnt-1]['url'] != $nav):
				array_push($_SESSION['bc'], $next_breadcrumb);
			endif;
				if(count($_SESSION['bc']) > 5):
					array_shift($_SESSION['bc']);
				endif;
		endif;
	}
}