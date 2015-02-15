<?php

class form_helper_submit extends view_abstract
{
	public function __construct($options)
	{
		$this->registry = return_registry();

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

		if(!empty($options['content'])):
            $value = " value=\"{$options['content']}\"";
        else: $value = null;
        endif;

        if(!empty($options['labelClass'])):
            $labelClass = " class=\"{$options['labelClass']}\"";
        else: $labelClass = null;
        endif;

        if(!empty($options['labelId'])):
            $labelId = " id=\"{$options['labelId']}_label\"";
        else: $labelId = null;
        endif;

        if(!empty($options['labelName'])):
            $labelName = " name=\"{$options['labelName']}\"";
        else: $labelName = null;
        endif;

        if(!empty($options['labelStyle'])):
            $labelStyle = " style=\"{$options['labelStyle']}\"";
        else: $labelStyle = null;
        endif;

        if(!empty($options['labelContent'])):
            $labelContent = $options['labelContent'];
        else: $labelContent = null;
        endif;

        if(isset($_POST[$options['name']])):
        	$value = "value = \"{$_POST[$options['name']]}\"";
        endif;

        echo "
        <dl><dt><label for=\"{$options['name']}\"{$labelClass}{$labelId}{$labelStyle}>{$labelContent}</label></dt>\n
        <dd><input type='submit' {$value}{$class}{$id}{$name}{$style} /></dd></dl>\n";
	}
}