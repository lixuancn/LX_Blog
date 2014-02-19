<?php
/**
 * Mysql 数据库操作封装类.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */

class Mysql  {
	
	public $debug = true;
	
	public $dsn = array();
	
	protected $conn = null;
	
	/**
	 * 初始化函数  ...
	 * @param Array $dsn
	 */
	function __construct($dsn) {
		$this->dsn = $dsn;
	}

	function connect($host, $user, $password, $db='', $dbcharset = 'utf8', $pconnect=0) {
		//长短连接区分
		$func = $pconnect == 1 ? 'mysql_pconnect' : 'mysql_connect';
		if (!$this->conn = @$func($host, $user, $password)) {
			$this->halt('Can not connect to MySQL server!');
		}
		//设置字符集
		$this->query("SET names " . $dbcharset);
		//选择数据库
		if(!empty($db)) {
			$this->select_db($db);
		}
	}
	
	function select_db($dbName) {
		if (!@mysql_select_db($dbName, $this->conn)) {
			$this->halt('Cannot use database:'.$dbName);
		}
	}
	
	function close() {
		@mysql_close($this->conn);
	}
	
	function query($sql = '', &$useMaster = false) {
		if (empty($this->conn)) {
			$this->connect($this->dsn['host'].':'.$this->dsn['port'], $this->dsn['user'], $this->dsn['password'], $this->dsn['db']);
		}
		//选择数据库
		if(!empty($this->dsn['db'])) {
			$this->select_db($this->dsn['db']);
		}
		if (!$query = @mysql_query($sql, $this->conn)) {
			$this->halt('Mysql query error:' . $sql);
		}
		return $query;
	}

	function errno() {
		return mysql_errno();
	}
	
	function error() {
		return mysql_error();
	}
	
	function num_rows($query) {
		return @mysql_num_rows($query);
	}
	
	function num_fields($query) {
		return @mysql_num_rows($query);
	}
	
	function affected_rows() {
		return @mysql_affected_rows($this->conn);
	}
	
	function fetch_row($query) {
		return @mysql_fetch_row($query);
	}
	
	function fetch_assoc($query) {
		return @mysql_fetch_assoc($query);
	}
	
	function fetch_array($query, $type= MYSQL_ASSOC) {
		return @mysql_fetch_array($query, $type);
	}
	
	function insert_id() {
		return @mysql_insert_id($this->conn);
	}
	
	function halt($msg) {
		$dberror = $this->error();
		$dberrno = $this->errno();
		error_log($msg.$dberrno.$dberror);
		
		$this->debug && print "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
				<b>MySQL Error</b><br>
				<b>Message</b>: $msg<br>
				<b>Error</b>: $dberror<br>
				<b>Errno.</b>: $dberrno<br>
				</div>";
		exit();
	}
}
?>