<?php

class view_helper_validate extends view_abstract
{
	public $errors = array();
	public $validators = array();

	public function __set($name, $value)
	{
		switch($name):
			case 'source':
				if(!is_array($value)):
					throw new gException('Source must be an array');
				endif;
				$this->source = $value;
			break;

			default:
				$this->name = $value;
			break;
		endswitch;
	}

	public function __get($name)
	{
		return $this->$name;
	}

	public function addValidator( $validator )
	{
		if(!isset($this->validators[$validator['name']])):
			$this->validators[$validator['name']] = array();
		endif;

		$val = array();

		foreach($validator as $key=>$value):
			$val[$key] = $value;
		endforeach;

		$this->validators[$validator['name']][] = $val;

		return $this;
	}

	public function run()
	{
		foreach($this->validators as $key=>$val):
			foreach($val as $key=>$options):
				$this->checkRequired($options);
				switch($options['type']):
					case 'string':
						$this->validateString($options);
					break;

					case 'length':
						$this->validateStringLength($options);
					break;

					case 'numeric':
						$this->validateNumeric($options);
					break;

					case 'regex':
						$this->validateRegex($options);
					break;

					case 'float':
						$this->validateFloat($options);
					break;

					case 'date':
						$this->validatedate($options);
					break;

					case 'url':
						$this->validateUrl($options);
					break;

					case 'email':
						$this->validateEmail($options);
					break;

					case 'injection':
						$this->validateEmailInjection($options);
					break;

					case 'ipv4':
						$this->validateIpv4($options);
					break;

					case 'ipv6':
						$this->validateIpv6($options);
					break;

					case 'callback':
						$this->validateCallback($options);
					break;

					default:
						throw new Exception( "Invalid Type" );
					break;
				endswitch;
			endforeach;
		endforeach;
	}

	private function checkRequired($values)
	{
		$message =  $this->parseCamelCase($values['name']) . ' is a required field';
		$message = isset($values['message']) ? $values['message'] : $message;

		if(isset($values['required']) && $values['required'] === true):
			if($this->source[$values['name']] == ''):
				$this->errors[] = $message;
			endif;
		endif;
	}

	private function validateString($values)
	{
		$message = $this->parseCamelCase($values['name']) . ' is Invalid';
		$message = isset($values['message']) ? $values['message'] : $message;
		$name = $values['name'];
		if(!is_string($this->source[$name])):
			$this->errors[] = $message;
		endif;
	}

	private function validateStringLength($values)
	{
		$message = $this->parseCamelCase($values['name']). ' must be between ' . $values['min'] . ' and ' . $values['max'] . ' characters long';
		$message = isset($values['message']) ? $values['message'] : $message;

		if( strlen($this->source[$values['name']]) > $values['max'] || strlen($this->source[$values['name']]) < $values['min']):
			$this->errors[] = $message;
		endif;
	}

	public function validateRegex($values)
	{
		$default_message = $this->parseCamelCase($values['name']) . ' does not match the required pattern';
		$message = isset($values['message']) ? $values['message'] : $default_message;

		if( !preg_match("'".$values['pattern']."'", $this->source[$values['name']])):
			$this->errors[] = $message;
		endif;
	}

	private function validateNumeric($options)
	{
		$default_message = $this->parseCamelCase($options['name']) . ' must be a number';
		$message = isset($options['message']) ? $options['message'] : $default_message;

		if( filter_var( $this->source[$options['name']], FILTER_VALIDATE_INT ) != true ):
			$this->errors[] = $message;
		endif;
	}

	private function validateEmail($options)
	{
		$default_message = $this->parseCamelCase($options['name']) . ' is not a valid email address';
		$message = isset($options['message']) ? $options['message'] : $default_message;

		if(filter_var( $this->source[$options['name']], FILTER_VALIDATE_EMAIL ) === FALSE ):
			$this->errors[] = $message;
		endif;
	}

	private function validateEmailInjection($options)
	{
		$default_message = $this->parseCamelCase($options['name']) . ' contains injection characters';
		$message = isset($options['message']) ? $options['message'] : $default_message;

		if (preg_match( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' ,$this->source[$options['name']])):
			$this->errors[] = $message;
		endif;
	}

	private function validateFloat($options)
	{
		$message =  $this->parseCamelCase($options['name']) . ' is not a valid floating point number';
		$message = isset($options['message']) ? $options['message'] : $message;

		if(filter_var( $this->source[$options['name']], FILTER_VALIDATE_FLOAT ) === false ):
			$this->errors[] = $message;
		endif;
	}

	private function parseCamelCase($string)
	{
		$cc = preg_replace('/(?<=[a-z])(?=[A-Z])/',' ',$string);
		$cc = ucwords(str_replace( '_', ' ', $cc));

		return $cc;
	}

	private function validateUrl($options)
	{
		$message =  $this->parseCamelCase( $options['name'] ) . ' is not a valid URL';
		$message = isset( $options['message'] ) ? $options['message'] : $message;

		if(filter_var( $this->source[$options['name']], FILTER_VALIDATE_URL) === FALSE ):
			$this->errors[] = $message;
		endif;
	}

	private function validateDate($options)
	{
		$message =  $this->parseCamelCase($options['name']) . ' is not a valid date';
		$message = isset($options['message']) ? $options['message'] : $message;

		switch($options['format']):
			case 'YYYY/MM/DD':
			case 'YYYY-MM-DD':
				list($y, $m, $d) = preg_split('/[-\.\/ ]/', $this->source[$options['name']]);
			break;

			case 'YYYY/DD/MM':
			case 'YYYY-DD-MM':
				list($y, $d, $m) = preg_split('/[-\.\/ ]/', $this->source[$options['name']]);
			break;

			case 'DD-MM-YYYY':
			case 'DD/MM/YYYY':
				list($d, $m, $y) = preg_split('/[-\.\/ ]/', $this->source[$options['name']]);
			break;

			case 'MM-DD-YYYY':
			case 'MM/DD/YYYY':
				list($m, $d, $y) = preg_split('/[-\.\/ ]/', $this->source[$options['name']]);
			break;

			case 'YYYYMMDD':
				$y = substr($this->source[$options['name']], 0, 4);
				$m = substr($this->source[$options['name']], 4, 2);
				$d = substr($this->source[$options['name']], 6, 2);
			break;

			case 'YYYYDDMM':
				$y = substr($this->source[$options['name']], 0, 4);
				$d = substr($this->source[$options['name']], 4, 2);
				$m = substr($this->source[$options['name']], 6, 2);
			break;

			default:
				throw new gException( "Invalid Date Format" );
			break;
		endswitch;

		if(checkdate( $m, $d, $y ) == false):
			$this->errors[] = $message;
		endif;
	}

	private function validateIpv4($options)
	{
		$message =  $this->parseCamelCase($options['name']) . ' is not a valid ipv4 address';
		$message = isset($options['message']) ? $options['message'] : $message;

		if(filter_var($this->source[$options['name']], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === FALSE):
			$this->errors[] = $message;
		endif;
	}

	private function validateIpv6($options)
	{
		$message = $this->parseCamelCase($options['name']) . ' is not a valid ipv6 address';
		$message = isset($options['message']) ? $options['message'] : $message;

		if(filter_var($this->source[$options['name']], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === FALSE):
			$this->errors[] = $message;
		endif;
	}

	public function validateCallback($options)
	{
		$message =  $this->parseCamelCase( $options['name'] ) . ' is invalid';
		$message = isset( $options['message'] ) ? $options['message'] : $message;

		$registry = return_registry();

		if(isset($options['class'])):
			$class = $options['class'];
			$func = $options['function'];
			$obj = new $class($registry);

			if($obj->$func($this->source[$options['name']] ) == true):
				$this->errors[] = $message;
			endif;
		else:
			$func = $options['function'];

			if($func($this->source[$options['name']]) == true):
				$this->errors[] = $message;
			endif;
		endif;
	}

	private function errorMessage($options)
	{

	}
}