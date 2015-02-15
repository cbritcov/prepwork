<?php

class view_helper_h extends view_abstract
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

		if(!empty($options['number'])):
			$number = $options['number'];
		else: $number = null;
		endif;

		echo "\n<h{$number}{$class}{$id}{$name}{$style}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</h{$number}>\n";
	}
}