<?php

class view_helper_breadcrumb extends view_abstract
{
	public function __construct()
	{
		$lim = count($_SESSION['bc']);

		if(empty($_SESSION['bc'])):
			$cnt = 0;
		else: $cnt = $lim-1;
		endif;

		if($cnt >= 4):
			$max = $cnt-4;
		else: $max = 0;
		endif;

		for($i=$lim-1; $i >= $max; $i--):
			if($i == $cnt):
				$class = 'lastCrumb';
				$arrow = null;
				$type = 'span';
				$href='null';
			else:
				$class = 'crumb';
				$arrow = '&#187;';
				$type = 'link';
				$href = $_SESSION['bc'][$i]['url'];
			endif;

			$breadcrumbs[] = array(
				'type' => $type,
				'href' => $href,
				'class' => $class,
				'content' => $_SESSION['bc'][$i]['name'].' '.$arrow.'&nbsp;'
			);
		endfor;

		if(!empty($breadcrumbs)):
			$breadcrumbs = array_reverse($breadcrumbs);
			$this->displayContent($breadcrumbs);
		endif;
	}
}