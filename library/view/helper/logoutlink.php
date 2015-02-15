<?php

class view_helper_logoutlink extends view_abstract
{
	public function __construct($options)
	{
		if(!empty($options['class'])):
			$class = " class=\"{$options['class']}\"";
		else: $class = null;
        endif;

		if(!empty($options['content'])):
			$content = " content=\"{$options['content']}\"";
		else: $content = null;
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

		$href = " href=\"".eregi_replace('/index.php', '', $_SERVER['PHP_SELF'])."/user/logout/\"";

		if(!empty($options['rel'])):
			$rel = " target=\"{$options['rel']}\"";
		else: $rel = null;
		endif;

		echo "\n<a{$href}{$class}{$id}{$name}{$style}{$rel}>";

        if(!empty($content)):
            echo $content;
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</a>";
	}
}