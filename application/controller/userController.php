<?php

class userController extends controller_abstract
{
	function indexAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Welcome!';
		$this->view();
	}

	function listAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'User Lists';
		$this->view();
	}

	function loginAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'User Login';
		$this->view();
	}

	function contactAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Contact Us';
		$this->view();
	}

	function processloginAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Processing Login';

		if(!empty($_SESSION['navigator'])):
			if($this->registry->db->login($_SESSION['navigator']['username'], $_SESSION['navigator']['password'])):
				unset($_SESSION['navigator']);
				$this->registry->navigator->redirect(array('url'=>'index/index', 'messenger' => 'You have logged in successfully', 'type' => 'success'));
			else:
				unset($_SESSION['navigator']);
				$this->registry->navigator->redirect(array('url'=>'user/login', 'messenger' => 'There was a problem and you could not be logged in', 'type' => 'failure'));
			endif;
		else: $this->registry->navigator->redirect(array('url'=>'user/login', 'messenger' => 'An error occured, please login again', 'type' => 'failure'));
		endif;
	}

	function logoutAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Processing Logout';
		unset($_SESSION['user']);
		$this->registry->navigator->redirect(array('url'=>'user/login', 'messenger' => 'You have logged out successfully', 'type' => 'success'));
	}

	function registerAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Registration';
		$this->view();
	}

	function processregisterAction()
	{
		$this->pageTitle = 'Prepwork';
		$this->mainTitle = 'Processing Registration';

		if(!empty($_SESSION['navigator'])):
			if($this->registry->db->register($_SESSION['navigator']['email'], $_SESSION['navigator']['username'], $_SESSION['navigator']['password'])):
				unset($_SESSION['navigator']);
				$this->registry->navigator->redirect(array('url'=>'index/index', 'messenger' => 'Registration Successful - Please check your Email Inbox', 'type' => 'success'));
			else:
				unset($_SESSION['navigator']);
				$this->registry->navigator->redirect(array('url'=>'user/login', 'messenger' => 'There was a problem and your Registration could not be completed', 'type' => 'failure'));
			endif;
		else: $this->registry->navigator->redirect(array('url'=>'user/login', 'messenger' => 'An error occured, please register again', 'type' => 'failure'));
		endif;
	}

}