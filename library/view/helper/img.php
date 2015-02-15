<?php

class view_helper_img extends view_abstract
{
	public function __construct($options)
	{
		if(!isset($options['src']))
		    throw new gException("XHTML image tag requires source");

		if(!isset($options['alt']))
		    throw new gException("XHTML image tag requires alt");

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

		if(!empty($options['src'])):
			$src = " src=\"".eregi_replace('/index.php', '', $_SERVER['PHP_SELF'])."graphics/'.{$options['src']}\"";
		else: $src = null;
		endif;

		if(!empty($options['alt'])):
			$alt = " alt=\"{$options['alt']}\"";
		else: $alt = null;
		endif;

		echo "\n<img{$src}{$alt}{$class}{$id}{$name}{$style} />\n";
	}
}