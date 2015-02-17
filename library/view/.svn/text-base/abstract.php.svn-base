<?php

abstract class view_abstract
{
	public $registry;

	public function __construct($registry)
	{
		$this->registry = $registry;
		$this->validated = 'no';
	}

    public function displayContent($content)
    {
        foreach($content as $data):
            if(empty($data['type'])):
            	throw new gException("Class ".get_class($this)."::displayContent Requires a tag type");
            else:
            	if(class_exists('form_helper_'.$data['type'])):
            		$class = 'form_helper_'.$data['type'];
            	elseif(class_exists('view_helper_'.$data['type'])):
            		$class = 'view_helper_'.$data['type'];
            	else: throw new gException('class '.get_class($this).' cannot find the helper '.$data['type']);
            	endif;
            	$new = new $class($data);
            endif;
        endforeach;
    }

    public function get_registry()
    {
    	return $this->registry;
    }
};