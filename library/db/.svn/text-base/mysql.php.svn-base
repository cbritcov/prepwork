<?php

abstract class db_mysql
{
	protected $registry;
	public $test;
	public $connection;

	public function __construct($registry)
	{
		$this->registry = $registry;
		$this->configs = parse_ini_file('../application/config/db.ini.php', true);
		self::connect();
		self::prepare();
	}

	public function connect()
	{
		$this->connection = mysql_connect($this->configs['mysql']['db_server'], $this->configs['mysql']['db_username'], $this->configs['mysql']['db_password']);

		if(!$this->connection):
			throw new gException("Could not connect to MySQL Server");
		endif;

		if(!mysql_select_db($this->configs['mysql']['db_name'], $this->connection)):
			throw new gException("Database ".$this->configs['mysql']['db_name']." could not be found");
		endif;
	}

	public function get_connection()
	{
		return $this->connection;
	}

	public function query($query)
	{
		if(empty($query)):
			throw new gException(get_class($this).'::query requires a query to be set');
		endif;

		return @mysql_query($query, $this->connection);
	}

	public function fetch_array($result)
	{
		if(empty($result)):
			throw new gException(get_class($this).'::fetch_array requires a result to be set');
		endif;

		return @mysql_fetch_array($result);
	}

	public function fetch_assoc($result)
	{
		if(empty($result)):
			throw new gException(get_class($this).'::fetch_assoc requires a result to be set');
		endif;

		return @mysql_fetch_assoc($result);
	}

	public function getArray($query)
	{
		if(empty($query)):
			throw new gException(get_class($this).'::getArray requires a query to be set');
		endif;

		if(($result = self::query($query))):
			while(($array = self::fetch_array($result))):
				$data[]= $array;
			endwhile;

			if(!empty($data)):
				return $data;
			else: return NULL;
			endif;
		endif;

		return ;
	}

	public function prepare()
	{
		$model = $this->registry->router->controller;
		$tables = $this->configs['tables'];

		foreach($tables as $table => $key):
			$tablename = explode('.', $table);
			$model = $tablename[0];
			$columns[] = $tablename[1];
			$query[] = $key;
		endforeach;

		self::create_table($model, $query);
		self::check_columns($model, $columns);
	}

	function create_table($model, $q)
	{
		$query = "CREATE TABLE IF NOT EXISTS ".$model.' (';

		$qcount = count($q);

		$i=0;
		foreach($q as $result):
			$query .= $result;
			if($i < ($qcount-1)):
				$query .= ', ';
			endif;
			++$i;
		endforeach;

		$query .= ')';

		return mysql_query($query, $this->connection);
	}

	function check_columns($model, $columns)
	{

		$col = mysql_query("SHOW columns FROM ".$model, $this->connection);

		if($col):
			while(($c = mysql_fetch_assoc($col))):
				if(!in_array($c['Field'], $columns)):
					self::drop_column($c['Field'], $model);
				endif;
			endwhile;

			foreach($columns as $column):
				if($column != 'primary'):
					self::add_column($model, $column);
				endif;
			endforeach;
		endif;
	}

	function add_column($model, $column)
	{
		$exists = false;

		$columns = mysql_query("SHOW columns FROM ".$model, $this->connection);

		while((($c = mysql_fetch_assoc($columns)))):
			if($c['Field'] == $column):
				$exists = true;
				break;
			endif;
		endwhile;

		if(!$exists):
			$query = $this->configs['tables'][$model.'.'.$column];
			mysql_query("ALTER TABLE {$model} ADD {$query}", $this->connection);
		endif;

		return;
	}

	public function drop_column($column, $model)
	{
		return mysql_query("ALTER TABLE ".$model." DROP ".$column, $this->connection);
	}
};