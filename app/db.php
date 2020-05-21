<?php

	#
#	Short Model
#	Jafran Hasan
	#

class Database {

    protected $connection;
	protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
	public $query_count = 0;

	protected $q_ready = false;
	protected $q_type = 'select';
	protected $q_select = '*';
	protected $q_insert = false;
	protected $q_limit = false;
	protected $q_order = false;
	protected $q_orderby = false;
	protected $q_offset = false;
	protected $q_where = [];
	protected $q_whereOr = [];
	protected $q_set = false;
	protected $q_out_limit = false;
	protected $q_table = false;
	protected $q_join = false;

	public function __construct() {	
		
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'microblog';
		$charset = 'utf8';
		
		
		$this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($this->connection->connect_error) {
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
		$this->connection->set_charset($charset);
	}

    public function query($query) {
        if (!$this->query_closed) {
            $this->query->close();
        }
		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
           	if ($this->query->errno) {
				$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}
            $this->query_closed = FALSE;
			$this->query_count++;
		} 
		else {
			$this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);			
        }
		return $this;
    }

	public function fetchAll() {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}

	public function fetchArray() {
	    $params = array();
        $row = array();
		$meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
		call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}

	public function close() {
		return $this->connection->close();
	}

    public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}

    public function lastInsertID() {
    	return $this->connection->insert_id;
    }

    public function error($error) {
        if ($this->show_errors) {
            return $error;
            exit();
        }
    }

	private function _gettype($var) {
	    if (is_string($var)) return 's';
	    if (is_float($var)) return 'd';
	    if (is_int($var)) return 'i';
	    return 'b';
	}




	public function select( $selects = '*' )
	{
		$this->q_select = is_array($selects) ? implode(', ', $selects) : $selects;
		return $this;
	}
	
	public function from( string $table )
	{
		$this->q_table = $table;
		return $this;
	}

	public function id(int $id )
	{
		$this->q_where = ['id' => $id];
		$this->q_out_limit = 1;
		$this->q_limit = 1;

		
		if($this->q_type == 'select') return $this->get();

		return $this;
	}
	
	public function where( $condition = [] )
	{
		$this->q_where = array_merge($this->q_where, $condition);
		return $this;
	}
	public function whereOr( $condition = [] )
	{
		$this->q_whereOr = array_merge($this->q_whereOr, $condition);
		return $this;
	}

	public function set( $sets = [] )
	{
		$this->q_type = 'update';
		if(is_array($sets))
			$this->q_set = array_merge($sets);
		return $this;
	}

	public function insert( $insert )
	{
		if(!is_array($insert)) return $this;
		$this->q_type = 'insert';

		// return 'fff';
		
		$keys = array_keys($insert);
		$values = array_values($insert);
		$this->q_insert =  ' (' . implode(', ', $keys) . ') VALUES (' . $this->implodeWith($values, ',', TRUE) . ')';
		
		// return $this->getResult();
		$this->build_query();
		$query = $this->q_ready;
		// return $query;
		return $this->query($query)->lastInsertID();

	}

	public function build_set( array $sets, $glue = ',' )
	{
		$all_set = [];
		foreach($sets as $key => $val) {
			if(is_numeric($val))
				$all_set[] = $key . ' = ' . $val;
			else 
				$all_set[] = $key . ' = \'' . $val . '\'';
		}
		return implode($glue, $all_set);
	}

	public function implodeWith( array $array = [], $glue = ',' , $quote = false )
	{
		if($quote == true) {
			return '\'' . implode('\'' . $glue . ' \'', $array)  . '\'';
		}
		return implode($glue, $array);
	}

	protected function build_query(){
		// $query = false;
		
		$table = $this->q_table;
		$whereAnd = $this->q_where != null ? $this->build_set($this->q_where, ' AND ') : false;
		$whereOr = $this->q_whereOr != null ? $this->build_set($this->q_whereOr, ' AND ') : false;
		$where = ( $this->q_where || $this->q_whereOr ? ' WHERE ' : '') . (($whereAnd && $whereOr) ? '( ' . $whereAnd . ' )' : $whereAnd) . (($whereAnd && $whereOr) ? ' OR ( ' . $whereOr . ' )' : ($this->build_set($this->q_whereOr, ' OR ')));
		$sets = $this->q_set ? '' . $this->build_set($this->q_set, ', ') . '' : false;

		switch($this->q_type){
			case 'delete':
				$query = 'DELETE FROM ' . $table . $where;
				break;
			case 'update':
				$query = 'UPDATE ' . $table . ' SET ' . $sets . $where;
				break;
			case 'insert':
				$query = 'INSERT INTO ' . $table . $this->q_insert;
				break;
			case 'select':
			default:
				if($this->q_join === false){
					$query = 'SELECT ' . $this->q_select . ' FROM ' . $table . $where . $this->q_orderby . $this->q_order . $this->q_limit . $this->q_offset;
				} else {
					$query = 'SELECT ' . $this->q_select . ' FROM ' . $table . $where . $this->q_orderby . $this->q_order . $this->q_limit . $this->q_offset;
				}				
			break;
		}
		$this->q_ready = trim($query);
		return $this;
	}

	public function get()
	{
		$this->build_query();
		$query = $this->q_ready;
		// return $$query;
		if($this->q_type != 'select'){
			return $this->query($query)->affectedRows();
		}
		return $this->q_out_limit != 1 ? $this->query($query)->fetchAll() : (object) $this->query($query)->fetchArray();
	}

	public function in( $table = false )
	{
		if($table)
			$this->q_table = $table;		
		return $this;
	}

	public function into( $table = false )
	{
		if($table)
			$this->q_table = $table;		
		return $this;
	}

	public function table( $table = false )
	{
		if($table)
			$this->q_table = $table;		
		return $this;
	}

	public function getResult()
	{
		$this->build_query();
		return $this->query($this->q_ready)->affectedRows();
	}

	public function update($sets = [])
	{
		$this->q_type = 'update';
		
		$this->q_type = 'update';
		if(is_array($sets))
			$this->q_set = array_merge($sets);

		return $this->getResult();
	}

	public function delete(){
		$this->q_type = 'delete';	
		return $this->getResult();		
	}


	public function limit( $limit = false )
	{
		if($limit)
			$this->q_limit = ' LIMIT '. $limit;
		return $this;
	}
	public function orderby( $orderby = 'id' )
	{
		$this->q_orderby = ' ORDER BY ' . $orderby;
		return $this;
	}
	public function asc()
	{
		$this->q_order = ' ASC ';
		return $this;
	}
	public function desc()
	{
		$this->q_order = ' DESC ';
		return $this;
	}
	public function offset( $offest = false )
	{
		if($offset)
			$this->q_offset = ' OFFSET ' . $offset;
		return $this;
	}
	public function first($primary = 'id')
	{
		$this->q_limit = ' Limit 1';
		$this->q_order = ' ASC ';
		$this->q_orderby = ' ORDER BY ' . $primary;
		$this->q_out_limit = 1;
		return $this->get();
	}
	public function last($primary = 'id')
	{
		$this->q_limit = ' LIMIT 1';
		$this->q_order = ' DESC ';
		$this->q_orderby = ' ORDER BY ' . $primary;
		$this->q_out_limit = 1;
		return $this->get();
	}

	public function row(){
		return $this->fetchArray();
	}

	
	public function all(){
		return $this->fetchAll();
	}

	public function result(){
		return $this->affectedRows();
	}


	public function join($join, $on, $type = 'LEFT'){
		$this->q_join[] = [
			'join' => $join,
			'on' => $on,
			'type' => $type
		];
		return $this;
	}



}
