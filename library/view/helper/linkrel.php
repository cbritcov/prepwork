<?php

class view_helper_linkrel extends view_abstract
{
	public function __construct($options)
	{
		if(empty($options['href']))
		    throw new gException("XHTML Link tag requires href to be set");

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

		if(!empty($options['href'])):
			$href = " href=\"{$options['href']}\"";
		else: $href = null;
		endif;

		if(!empty($options['popup'])):
			$popup = " rel=\"{$options['popup']}\"";
		else: $popup = null;
		endif;

		if(!empty($options['rel'])):
			$rel = " target=\"{$options['rel']}\"";
		else: $rel = null;
		endif;

		echo "\n<a{$href}{$popup}{$class}{$id}{$name}{$style}{$rel}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</a>";
	}
}