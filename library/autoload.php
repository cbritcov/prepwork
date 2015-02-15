<?php

class autoload
{
	public function __construct($class)
	{
		$paths = parse_ini_file('../application/config/paths.ini.php', true);

		foreach($paths['include_paths'] as $path):
			$class = str_replace('_', '/', $class);
			$file = $path.$class.'.php';
			if(file_exists($file)):
				include $file;
				return;
			endif;
		endforeach;

		if(strstr($class, 'Controller')):
			throw new gException('Class \''.$class.'\' could not be loaded by the autoloader');
		endif;
	}
}