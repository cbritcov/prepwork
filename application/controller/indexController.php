<?php

class indexController extends controller_abstract
{
	function indexAction()
	{
		$this->pageTitle = 'Genius';
		$this->mainTitle = 'Welcome!';
		$this->view();
	}
}