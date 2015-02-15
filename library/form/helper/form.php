<?php

class form_helper_form extends view_abstract
{
	public function __construct($options)
	{
		$this->registry = return_registry();

		if(empty($options['redirect'])):
			throw new gException(get_class($this)."::validate requires an url for success redirection");
		endif;

		if(!empty($options['action'])):
			$action = " action=\"{$options['action']}\"";
		else: $action = " action = '".$_SERVER['REQUEST_URI']."'";
        endif;

		if(!empty($options['method'])):
			$method = " method=\"{$options['method']}\"";
		else: $method = " method=\"post\"";;
        endif;

		if(!empty($options['class'])):
			$class = " class=\"{$options['class']}\"";
		else: $class = null;
        endif;

		if(!empty($options['id'])):
			$id = " id=\"{$options['id']}\"";
		else: $id = null;
		endif;

		if(!empty($options['name'])):
			$name = " name=\"{$options['name']}\"";
		else: $name = null;
		endif;

		if(!empty($options['style'])):
			$style = " style=\"{$options['style']}\"";
		else: $style = null;
		endif;

		echo "\n<form{$action}{$method}{$class}{$id}{$name}{$style} enctype='multipart/form-data'>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</form>\n";

        if(!empty($_POST)):
        	if(!in_array('no', $this->registry->gatekeeper->validation)):
        		$this->registry->navigator->redirect($options['redirect']);
        	endif;
        endif;
	}
}