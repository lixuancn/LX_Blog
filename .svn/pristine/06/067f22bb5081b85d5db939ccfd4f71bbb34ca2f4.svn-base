<?php
/**
 * Mysql 主从数据库操作封装类.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */

class Mysqlrw{
	
	public $debug = true;
	
	public $dsn = array();
	
	const RETRY_TIMES = 5;
	
	protected $conn = null;
	protected $connMaster = null; //主库链接
	protected $connSlave = null; //从库链接
	
	/**
	 * 初始化函数  ...
	 * @param Array $dsn
	 */
	function __construct($dsn) {
		$this->dsn = $dsn;	
	}
	
	function connect($host, $user, $password, $db='', $dbcharset = 'utf8', $pconnect=0) {
		//长短连接区分
		//$func = $pconnect == 1 ? 'mysql_pconnect' : 'mysql_connect';
		$func = 'mysql_connect';
		$this->conn = @$func($host, $user, $password, true);
		
		$times = 1;
		while (!$this->conn && $times <= self::RETRY_TIMES){
			$this->conn = @$func($host, $user, $password, true);
			$times++;
		}
		if (!$this->conn) {
			$this->halt('Can not connect to MySQL server!');
		}
		
		//设置字符集
		@mysql_query("SET names " . $dbcharset, $this->conn);
		//选择数据库
		if(!empty($db)) {
			$this->select_db($db);
		}
	}
	
	/**
	 * 连接主数据库 ...
	 */
	function connect_master() {
		$this->conn = null;
		//链接主库
		$master = $this->dsn['master'];
		
		$this->connect($master['host'].':'.$master['port'],$master['user'],$master['password'], $master['db']);		
		if ($this->conn) {
			$this->connMaster = $this->conn;
		}
	}
	
	/**
	 * 连接从数据库 ...
	 */
	function connect_slave() {
		$this->conn = null;
		//随机链接从库
		$slave = $this->dsn['slave'][rand(0, count($this->dsn['slave'])-1)];
		$this->connect($slave['host'].':'.$slave['port'],$slave['user'],$slave['password'], $slave['db']);
		if ($this->conn) {
			$this->connSlave = $this->conn;
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
	
	function query($sql = '', &$useMaster = false, $func='mysql_query') {
		$orgUseMaster = $useMaster;
		if ($useMaster || !preg_match ("/^(\s*)select/i", $sql)) {			
			if (!$this->connMaster) {
				$this->connect_master();				
			} else {
				$this->conn = $this->connMaster;
			}	
			if (!@mysql_ping ($this->conn)) {
			   @mysql_close($this->conn);
			   $this->connMaster = null;
			    
			   $this->connect_master();
			}	
			$useMaster = false;
		} else {
			if(!$this->connSlave){
				$this->connect_slave();		
			} else {
				$this->conn = $this->connSlave;
			}
			if (!@mysql_ping ($this->conn)) {
			   @mysql_close($this->conn);
			   $this->connSlave = null;
			    
			   //$this->connect_slave();	
			   $this->connect_master();	
			}	
		}
		$query = @$func($sql, $this->conn);
		
		$times = 1;
		while(!$query && $times <= self::RETRY_TIMES) {
			$this->close();  //执行错误时先断开连接
			/**************************重连*********************/
			if ($orgUseMaster || !preg_match ("/^(\s*)select/i", $sql)) {
				$this->connect_master();
			} else {
				//$this->connect_slave();	
				$this->connect_master(); //出错时尝试主库，fix 2006错误
			}
			/**************************重连end*********************/
			$query = @$func($sql, $this->conn);
			$times++;
		}
		
		if (!$query) {
			if(PRINT_MYSQL_ERROR){
                $errno = $this->errno();
                if($errno == 0){//如果是error 0 再重试一次
                    $query = @mysql_query($sql, $this->conn);
                    if(!$query){
                        $this->halt('Mysql query error:' . $sql);
                    }
                }else{
                    $this->halt('Mysql query error:' . $sql);
                }
            }
            return false;
		}
		//echo "<br/>".$this->get_host_info()."<br/>";


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
		error_log('errno:'.$dberrno.',error:'.$dberror.',msg:'.$msg);
		
		$debugInfo = debug_backtrace();
		//$debugArr = $debugInfo;
		$debugArr = array();
		for( $i=count($debugInfo); $i>=0; $i--){
			$value = $debugInfo[$i];
			$debugArr[] = array('file'=>$value['file'], 'line'=>$value['line'], 'function'=>$value['function']);
		}
		$debugStr = json_encode($debugArr);
		error_log('mysql debug trace:'.$debugStr);
		
		$this->debug && print "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
				<b>MySQL Error</b><br>
				<b>Message</b>: $msg<br>
				<b>Error</b>: $dberror<br>
				<b>Errno.</b>: $dberrno<br>
				</div>";
//		exit();
		//throw new DBException($msg);
	}
}
?>