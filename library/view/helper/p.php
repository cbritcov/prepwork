<?php
class view_helper_p extends view_abstract
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

		echo "\n<p{$class}{$id}{$name}{$style}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</p>\n";
	}
}