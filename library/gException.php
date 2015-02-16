<?php

class gException extends Exception
{
	public function __construct($message)
	{
		printr('', 'Prepwork Exception');

		printr($message, 'Message');

		printr($this->file.'<br />Line: '.$this->getLine(), 'File');

		printr($this->getTraceAsString(), 'Stack Trace');

		printr(get_included_files(), 'Included Files');

		die();
	}
}