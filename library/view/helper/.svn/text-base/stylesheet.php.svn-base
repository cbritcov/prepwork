<?php

class view_helper_stylesheet extends view_abstract
{
	public function __construct($options)
	{
	    if(!isset($options['name']))
	        throw new gException("XHTML styleSheet tag requires script name to be set");

	    if(!empty($options['media'])):
	        $media = "media='{$options['media']}'";
	    else: $media = null;
	    endif;

		if(!empty($options['if'])):
            $start = "<!--[if {$options['if']}]>";
            $end = "<![endif]-->";
		else:
		    $start = null;
		    $end = null;
		endif;

		echo "{$start}<link rel='stylesheet' type='text/css' href='".eregi_replace('index.php', '', $_SERVER['PHP_SELF'])."css/{$options['name']}.css' {$media} />{$end}\n";
	}
}