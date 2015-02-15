<?php

class db extends db_mysql
{
	public function fetch($options)
	{
		if(empty($options)):
			throw new gException(get_class($this).'::fetch requires options');
		endif;

		if(empty($options['table'])):
			throw new gException(get_class($this).'::fetch requires a table name to be set');
		endif;

		if(!empty($options['select'])):
			if(!is_array($options['select'])):
				throw new gException(get_class($this).'::fetch requires select to be an array');
			endif;

			$count = count($options['select']);

			$select = null;
			for($i=0; $i<$count; $i++):
				if($i == $count-1):
					$select .= $options['select'][$i].' ';
				else: $select .= $options['select'][$i].', ';
				endif;
			endfor;
		else: $select = '*';
		endif;

		if(!empty($options['where'])):
			$where = ' where '.$options['where'];
		else: $where = null;
		endif;

		if(!empty($options['order'])):
			$order = ' order by '.$options['order'];
		else: $order = null;
		endif;

		if(!empty($options['limit'])):
			$limit = ' limit '.$options['limit'];
		else: $limit = null;
		endif;

		$query = 'select '.$select.' from '.$options['table'].$where.$order.$limit;

		return parent::getArray($query);
	}

	public function verify_exists_username()
	{
		$username = mysql_real_escape_string($_POST['username']);

		$query = mysql_query("select username from user", $this->connection);

		while(($array = mysql_fetch_array($query))):
			$names[] = $array['username'];
		endwhile;

		if($names)
		return !in_array($username, $names);

	}

	public function verify_notexists_username()
	{
		$username = mysql_real_escape_string($_POST['username']);

		$query = mysql_query("select username from user", $this->connection);

		while(($array = mysql_fetch_array($query))):
			$names[] = $array['username'];
		endwhile;
		
		if($names)
		return in_array($username, $names);

	}

	public function verify_notexists_email()
	{
		$email = mysql_real_escape_string($_POST['email']);

		$query = mysql_query("select email from user", $this->connection);

		while(($array = mysql_fetch_array($query))):
			$address[] = $array['email'];
		endwhile;
		
		if($address)		
		return in_array($email, $address);
	}

	public function verify_match_username_password()
	{
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);

		$query = mysql_query("select id from user where username = '{$username}' and password = '{$password}'", $this->connection);

		if(mysql_num_rows($query) > 0):
			return false;
		else: return true;
		endif;
	}

	public function login($username, $password)
	{
		$query = mysql_query("select * from user where username = '{$username}' and password = '{$password}' limit 1", $this->connection);

		if($query):
			$array=mysql_fetch_assoc($query);
			foreach($array as $user=>$key):
				$this->registry->session->set(array('key' => 'user', 'name' => $user, 'value' => $key));
			endforeach;
			return true;
		else: return false;
		endif;
	}

	public function register($email, $username, $password)
	{
		$usertype = 'user';
		$query = mysql_query("insert into user(email, username, password, usertype) values('$email', '$username', '$password', '$usertype')", $this->connection);
		if($query):
			return true;
		else: return false;
		endif;
	}
}