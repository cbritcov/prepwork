<?php
class view_helper_javascript extends view_abstract
{
	public function __construct($options)
	{
	    if(!isset($options['name']))
	        throw new gException("XHTML Javascript tag requires script name");

		echo "<script type=\"text/javascript\" language=\"javascript\" src=\"".eregi_replace('/index.php', '', $_SERVER['PHP_SELF'])."/javascript/".$options['name'].".js\"></script>\n";
	}
}