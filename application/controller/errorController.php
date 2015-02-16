<?php

class errorController extends controller_abstract
{
	function indexAction()
	{

	}

	function pagenotfoundAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Page Not Found';
		$this->view();
	}

	function accessdeniedAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Access Denied';
		$this->view();
	}
}