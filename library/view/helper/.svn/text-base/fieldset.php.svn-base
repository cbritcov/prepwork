<?php

class view_helper_fieldset extends view_abstract
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

        if(!empty($options['legendClass'])):
            $legendClass = " class=\"{$options['legendClass']}\"";
        else: $legendClass = null;
        endif;

        if(!empty($options['legendId'])):
            $legendId = " id=\"{$options['legendId']}\"";
        else: $legendId = null;
        endif;

        if(!empty($options['legendName'])):
            $legendName = " name=\"{$options['legendName']}\"";
        else: $legendName = null;
        endif;

        if(!empty($options['legendStyle'])):
            $legendStyle = " style=\"{$options['legendStyle']}\"";
        else: $legendStyle = null;
        endif;

		echo "\n<fieldset{$class}{$id}{$name}{$style}>\n";

		if(!empty($this->errorMessage)):
			echo "<div class='error'>{$this->errorMessage}</div>";
		endif;

        if(!empty($options['legend'])):
            echo "<legend{$legendClass}{$legendId}{$legendName}{$legendStyle}>{$options['legend']}</legend><br />\n";
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</fieldset>\n";
	}
}