<?php

class indexController extends controller_abstract
{
	function indexAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Welcome!';
		$this->view();
	}
}