<?php
class view_helper_inclusion extends view_abstract
{
	public function __construct($options)
	{
	    if(!file_exists($options['file'])):
	        throw new gException("class ".get_class($this)." cannot find the file ".$options['file']);
	    endif;

	    if(!empty($this->data)):
	    	extract($this->data);
	    endif;

        include $options['file'];
	}
}
