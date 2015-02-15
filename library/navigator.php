<?php

class navigator extends navigator_abstract
{
	public function redirect($data)
	{
		if(!empty($data['url'])):
			$url = $data['url'];
		else: throw new gException('class '.get_class($this).' requires a url to be set');
		endif;

		if(!empty($data['messenger'])):
			$message = $data['messenger'];
			if(!empty($data['type'])):
				$type = $data['type'];
			else: $type = 'dialog';
			endif;
			$_SESSION['messenger']['message'] = $message;
			$_SESSION['messenger']['type'] = $type;
		else: $message = null;
		endif;

		if(isset($_POST)):
			$_SESSION['navigator'] = $_POST;
		endif;

		header('Location: '.$this->registry->router->ini_data['site_path']['site_path'].$data['url']);
	}
}