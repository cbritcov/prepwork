<?php

class errorController extends controller_abstract
{
	function indexAction()
	{

	}

	function pagenotfoundAction()
	{
		$this->pageTitle = 'Genius';
		$this->mainTitle = 'Page Not Found';
		$this->view();
	}

	function accessdeniedAction()
	{
		$this->pageTitle = 'Genius';
		$this->mainTitle = 'Access Denied';
		$this->view();
	}
}