<?php

class view_helper_listlink extends view_abstract
{
	public function __construct($options)
	{
		if(empty($options['controller']))
		    throw new gException(get_class($this).' requires a controller to be set');

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

		if(!empty($options['get'])):
			$getcount = count($options['get']);
			for($i = 0; $i < $getcount; $i++):
				$get[$i] = $options['get'][$i];
			endfor;
		endif;

		$href = " href=\"".eregi_replace('/index.php', '', $_SERVER['PHP_SELF'])."/{$options['controller']}/list/";

		if(!empty($get)):
			foreach($get as $g):
				$href .= $g.'/';
			endforeach;
		endif;

		$href .= '"';

		if(!empty($options['rel'])):
			$rel = " target=\"{$options['rel']}\"";
		else: $rel = null;
		endif;

		echo "\n<a{$href}{$class}{$id}{$name}{$style}{$rel}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</a>";
	}
}