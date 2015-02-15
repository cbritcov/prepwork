<?php

class view_helper_brclear extends view_abstract
{
	public function __construct($options=null)
	{
	    if(isset($options['options'])):
    	    $opt = $options['options'];
    	else: $opt = "all";
	    endif;

		echo "<br clear=\"".$opt."\" />\n";
	}
}