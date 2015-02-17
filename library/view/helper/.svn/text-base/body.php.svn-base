<?php

class view_helper_body extends view_abstract
{
	public function __construct($options)
	{
		if(!empty($options['onload']))
			$onload = ' onload="'.$options['onload'].'"';
		else $onload = null;

		echo "</head>\n<body{$onload}>";

        if(!empty($options['content'])):
            echo $options['content'];
        endif;

        if(!empty($options['elements'])):
             $this->displayContent($options['elements']);
        endif;

        echo "</body>\n</html>\n";
	}
}