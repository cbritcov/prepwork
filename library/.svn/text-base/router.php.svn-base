<?php

class router extends router_abstract
{
	public function load($registry)
	{
		if(empty($this->controller_path)):
			throw new gException('Class '.get_class($this).' requires a controller path');
		endif;

		if(empty($this->view_path)):
			throw new gException('Class '.get_class($this).' requires a view path');
		endif;

		$ctrl = $this->controller_path.$this->controller.'Controller.php';
		$mdl = $this->model_path.$this->controller.'.php';

		if(file_exists($ctrl)):
			include $ctrl;
			$Cclass = $this->controller.'Controller';
			$Cmethod = $this->action.'Action';
			$controller = new $Cclass($this->registry);

			$Mclass = 'model_'.$this->controller;

			if(class_exists($Mclass)):
				$model = new $Mclass($this->registry);
			else: throw new gException('Class '.get_class($this).' cannot find the class '.$Mclass);
			endif;

			$this->script = $registry->script;

			if(method_exists($controller, $Cmethod)):
				$load = $controller->$Cmethod();
				if(file_exists($this->script)):
					return;
				else: throw new gException('Class '.get_class($this).' cannot find action file '.$this->script);
				endif;
			else: throw new gException('Class '.get_class($this).' cannot find the action method '.$Cmethod.' in controller '.$Cclass);
			endif;
		endif;

		throw new gException('Class '.get_class($this).' cannot find the file '.$this->script);
	}
}