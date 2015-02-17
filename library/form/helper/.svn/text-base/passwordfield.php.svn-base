<?php

class form_helper_passwordfield extends view_abstract
{
	public function __construct($options)
	{
		$this->registry = return_registry();

		if(!empty($options['validation']) && !empty($_POST)):
			$val = new view_helper_validate($this->registry);
			$val->source = $_POST;

			$field_name = $options['validation']['id'];

			if(!empty($options['validation'])):
				if(!empty($options['validation']['required'])):
					$val->addValidator(
						array(
							'name' => $field_name,
							'type' => 'string',
							'required' => true,
							'message' => $field_name.' is a required field'
						)
					);
				endif;
				if(!empty($options['validation']['length'])):
					$val->addValidator(
						array(
							'name'=> $field_name,
							'type'=>'length',
							'min'=>$options['validation']['length']['min'],
							'max'=>$options['validation']['length']['max']
						)
					);
				endif;
				if(!empty($options['validation']['email'])):
					$val->addValidator(
						array(
							'name'=> $field_name,
							'type'=>'email'
						)
					);
				endif;
				if(!empty($options['validation']['numeric'])):
					$val->addValidator(
						array(
							'name'=> $field_name,
							'type'=>'numeric',
							'required' => true,
							'min'=>$options['validation']['numeric']['min'],
							'max'=>$options['validation']['numeric']['max']
						)
					);
				endif;
				if(!empty($options['validation']['exists'])):
					$val->addValidator(
						array(
							'name'=> $field_name,
							'type'=>'callback',
							'class' => 'db',
							'function' => 'verify_exists_'.$field_name,
							'message' => $options['validation']['exists']['error_message']
						)
					);
				endif;
				if(!empty($options['validation']['notexists'])):
					$val->addValidator(
						array(
							'name'=> $field_name,
							'type'=>'callback',
							'class' => 'db',
							'function' => 'verify_notexists_'.$field_name,
							'message' => $options['validation']['notexists']['error_message']
						)
					);
				endif;
				if(!empty($options['validation']['match'])):
					$val->addValidator(
						array(
							'name'=> $field_name,
							'type'=>'callback',
							'class' => 'db',
							'function' => 'verify_match_'.$options['validation']['match']['to'].'_'.$field_name,
							'message' => $options['validation']['match']['error_message']
						)
					);
				endif;
			endif;

			$val->run();
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
        <dd><input type='password' {$value}{$class}{$id}{$name}{$style} />";
		if(!empty($val->errors)):
			echo "<div style='float: left; color: #aa4444'>".$val->errors[0]."</div>";
			$this->registry->gatekeeper->validation('no');
		else: $this->registry->gatekeeper->validation('yes');
		endif;
		echo "</dd></dl>\n";
	}
}