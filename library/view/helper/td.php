<?php

class view_helper_td extends view_abstract
{
	public function __construct($options)
	{
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

		echo "\n<td{$class}{$id}{$style}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</td>\n";
	}
}