<?php

class view_helper_script extends view_abstract
{
	public function __construct($options)
	{
		if(!empty($options['script'])):
			$script = " type=\"{$options['script']}\"";
		else: throw new gException(get_class($this).' requires a script definition');
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

		echo "\n<script{$script}{$class}{$id}{$style}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</script>\n";
	}
}