<?php
/**
 * 数据模型基本类.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */

class DbModel {

	public $debug = false; //输出调试信息
	private $_dbObj = null; //数据库操作对象
	public $_useMaster = false; //是否使用主库

	const _SQL_SELECT_PAGE_LIST = "SELECT %s from %s WHERE %s %s LIMIT %s;";//查询分页信息
	const _SQL_SELECT_LIST = "SELECT %s from %s WHERE %s %s";//查询信息
	const _SQL_SELECT_ONE = "SELECT %s from %s WHERE %s LIMIT 0,1;";//查询信息
	const _SQL_COUNT = "SELECT COUNT(*) AS num FROM %s WHERE %s;";//查询合条件的记录数
	const _SQL_UPDATE = "UPDATE %s SET %s WHERE %s;";//更新SQL
	const _SQL_DELETE = "DELETE FROM %s WHERE %s;"; //删除信息
	const _SQL_INSERT = "INSERT INTO %s (%s) VALUES (%s);";//插入单条记录SQL
	const _SQL_INSERT_LIST = "INSERT INTO %s (%s) VALUES %s;";//插入d多条记录SQL\
	const _SQL_INSERT_DUPLICATE_UPDATE = "INSERT INTO %s (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s;";//插入同时有重复的执行UPDATE
	const _SQL_REPLACE = "REPLACE INTO %s SET %s;"; //REPLACE插入或更新
	
	function __construct($app='') {
		$app = $app ? $app : DEFAULT_DB;
		$dsn = $GLOBALS['db_config'][$app];
		$this->_dbObj = DB::getCon($dsn);
	}

	function useMasterDB() {
		$this->_useMaster = true;
	}

	/**
	 * 自定义查询...
	 * @param string $sql SQL语句
	 * @return multitype:
	 */
	function customSelect($sql='') {
		$data = array();
		$this->debug && print "sql = ".$sql."<br/>";

		$res = $this->_dbObj->query($sql, $this->_useMaster);
		while($row=$this->_dbObj->fetch_array($res)){
			$data[] = $row;
		}

		return $data;
	}

	function customQuery($sql)
	{
		if ($this->debug) echo 'sql = ', $sql , '<br/>';

		$res = $this->_dbObj->query($sql, $this->_useMaster);
		return $res;
	}

	/**
	 * 获取一条数据 ...
	 * @param string $table
	 * @param string $where
	 * @return multitype:
	 */
	function selectOne($table, $where, $fields="*") {
		$sql = sprintf(self::_SQL_SELECT_ONE, $fields, $table, $where);
		$this->debug && print "sql = ".$sql."<br/>";

		$res = $this->_dbObj->query($sql, $this->_useMaster);
		$row = $this->_dbObj->fetch_array($res);

		return $row;
	}
	
	/**
	 * 获取大数据结构集，用mysql_unbuffered_query,fix errno0的问题
	 * @param unknown_type $table
	 * @param unknown_type $where
	 * @param unknown_type $fields
	 */
	function selectOneWithoutBuff($table, $where, $fields="*") {
		$sql = sprintf(self::_SQL_SELECT_ONE, $fields, $table, $where);
		$this->debug && print "sql = ".$sql."<br/>";

		$res = $this->_dbObj->query($sql, $this->_useMaster, 'mysql_unbuffered_query');
		$row = $this->_dbObj->fetch_array($res);

		return $row;
	}

	/**
	 * 获取分页列表 ...
	 * @param string $table 表名
	 * @param string $where 查询条件
	 * @param string $limit 取记录数
	 * @param string $fields 查询字段
	 * @param string $order 排序
	 * @return Ambigous <multitype:, unknown>
	 */
	function selectPageList($table, $where, $page=1, $pagesize=20, $fields="*", $order="", $sumFields ="", $isGetNav=true) {
		$info = array('data' => array());
		if($sumFields != ""){
			$info['sums']  = $this->selectOne($table, $where, $sumFields);
		}
		//组织SQL
		$order = $order ? "ORDER BY " . $order : '';
		$limit = ($page-1)*$pagesize . "," . $pagesize;
		$sql = sprintf(self::_SQL_SELECT_PAGE_LIST, $fields, $table, $where, $order, $limit);
		$this->debug && print "sql = ".$sql."<br/>";
		//分页数据
		$res = $this->_dbObj->query($sql, $this->_useMaster);
		while($row=$this->_dbObj->fetch_array($res)){
			$info['data'][] = $row;
		}
		//分页导航
		$total = $this->getCounter($table, $where);
		if($isGetNav){
			$info['page_nav'] = $this->getPageNav($total, $page, $pagesize);
		}
		$info['total'] = $total;
		return $info;
	}

	/**
	 * 获取全部信息 ...
	 * @param string $table 表名
	 * @param string $where 查询条件
	 * @param string $fields 查询字段
	 * @param string $order 排序
	 * @return Ambigous <multitype:, unknown>
	 */
	function selectList($table, $where, $fields="*", $order="") {
		$data = array();
		//组织SQL
		$order = $order ? "ORDER BY " . $order : '';
		$sql = sprintf(self::_SQL_SELECT_LIST, $fields, $table, $where, $order);
		$this->debug && print "sql = ".$sql."<br/>";
		$res = $this->_dbObj->query($sql, $this->_useMaster);		
		while($row=$this->_dbObj->fetch_array($res)){
			$data[] = $row;
		}

		return $data;
	}
	
	/**
	 * 获取大数据list结构集
	 */
	function selectListWithoutBuff($table, $where, $fields="*", $order="", $limit="") {
		$data = array();
		//组织SQL
		$order = $order ? "ORDER BY " . $order : '';
		$limit = $limit ? "LIMIT " . $limit : '';
		$sql = sprintf(self::_SQL_SELECT_LIST, $fields, $table, $where, $order, $limit);
		$this->debug && print "sql = ".$sql."<br/>";
		$res = $this->_dbObj->query($sql, $this->_useMaster, 'mysql_unbuffered_query');
		while(($row=$this->_dbObj->fetch_array($res)) != false){
			$data[] = $row;
		}
		
		return $data;
	}

	/**
	 * 获取查询总数，与getPageList()函数结合使用...
	 * @param string $table 表名
	 * @param string $where 查询条件
	 * @return number
	 */
	function getCounter($table, $where) {
		$sql = sprintf(self::_SQL_COUNT, $table, $where);
		$this->debug && print "sql = ".$sql."<br/>";

		$res = $this->_dbObj->query($sql, $this->_useMaster);
		$data = $this->_dbObj->fetch_array($res);

		return $data['num'];
	}

	/**
	 * 更新数据 ...
	 * @param string $table 表名
	 * @param string $fields 字段数组
	 * @param string $where 查询条件
	 * @return boolean
	 */
	function update($table, $fields, $where) {
		if (empty($table) || empty($fields) || empty($where)) return false;

		$set = $s = '';
		foreach($fields as $k=>$v){
			$set .=  $s . "`$k`='".$this->escapeMysqlString($v)."'";
			$s = ',';
		}
		$sql = sprintf(self::_SQL_UPDATE, $table, $set, $where);
		$this->debug && print "sql = ".$sql."<br/>";

		return $this->_dbObj->query($sql);
	}

	/**
	 * 只删除一条数据...
	 * @param string $table 表名
	 * @param string $where 查询条件
	 * @return boolean
	 */
	function deleteOne($table, $where) {
		if (empty($table) || empty($where)) return false;

		if ($this->getCounter($table, $where) > 1) {
			$this->debug && print "Don't allowed to delete much rows!<br/>";
			return false;
		}

		$sql = sprintf(self::_SQL_DELETE, $table, $where);
		$this->debug && print "sql = ".$sql."<br/>";

		return $this->_dbObj->query($sql);
	}

	/**
	 * 删除多条数据 ...
	 * @param string $table 表名
	 * @param string $where 查询条件
	 * @return boolean
	 */
	function deleteList($table, $where) {
		if (empty($table) || empty($where)) return false;

		$sql = sprintf(self::_SQL_DELETE, $table, $where);
		$this->debug && print "sql = ".$sql."<br/>";

		return $this->_dbObj->query($sql);
	}

	/**
	 * 插入一条记录 ...
	 * @param string $table 表名
	 * @param array $fields 字段列表
	 * @return boolean
	 */
	function insertOne($table, $fields) {
		if (empty($table) || empty($fields)) return false;

		$fieldStr = "`" . implode("`,`", array_keys($fields)) . "`";
		$valueStr = "";
		$values = array_values($fields);
		foreach ($values as $value) {
			$valueStr .= "'".$this->escapeMysqlString($value)."',";			
		}
		$valueStr = substr($valueStr, 0, -1);
		$sql = sprintf(self::_SQL_INSERT, $table, $fieldStr, $valueStr);
		$this->debug && print "sql = ".$sql."<br/>";

		return $this->_dbObj->query($sql);
	}

	function insertId() {
		return $this->_dbObj->insert_id();
	}
	
	function affectedRows(){
		return $this->_dbObj->affected_rows();
	}

	/**
	 * 插入多条记录 ...
	 * @param string $table 表名
	 * @param array $fields 多维数组
	 * @return boolean
	 */
	function insertList($table, $fields) {
		if (empty($table) || empty($fields) || !is_array($fields)) return false;

		$fields = array_values($fields);

		$fieldStr = "`" . implode("`,`", array_keys($fields[0])) . "`";
		$valueStr = $s = "";
		foreach($fields as $row){
			$tmp = '';
			$values = array_values($row);
			foreach($values as $value) {
				$tmp .= "'".$this->escapeMysqlString($value)."',";
			}
			$valueStr .= $s . "(" . substr($tmp, 0, -1) . ")";
			$s = ",";
		}
		$sql = sprintf(self::_SQL_INSERT_LIST, $table, $fieldStr, $valueStr);
		$this->debug && print "sql = ".$sql."<br/>";
		return  $this->_dbObj->query($sql);
	}
	
	/**
	 * 插入一条记录重复就执行更新段 ...
	 * @param string $table 表名
	 * @param array $fields 字段列表
	 * @param string $duplicateUpdateFields 更新的字段列表
	 * @return boolean
	 */
	function insertDuplicateUpdate($table, $fields, $duplicateUpdateFields) {
		if (empty($table) || empty($fields) || empty($duplicateUpdateFields)) return false;
		
		$fieldStr = "`" . implode("`,`", array_keys($fields)) . "`";
		$valueStr = "";
		$values = array_values($fields);
		foreach ($values as $value) {
			$valueStr .= "'".$this->escapeMysqlString($value)."',";
		}
		$valueStr = substr($valueStr, 0, -1);
		$tmp = array();
		foreach($duplicateUpdateFields as $k=>$v){
			$tmp[] = "$k='".$this->escapeMysqlString($v)."'";
		}
		$duplicate_update = implode(",", $tmp);
		$sql = sprintf(self::_SQL_INSERT_DUPLICATE_UPDATE, $table, $fieldStr, $valueStr, $duplicate_update);
		$this->debug && print "sql = ".$sql."<br/>";
		return $this->_dbObj->query($sql);
	}
	
	/**
	 * 没有则插入，有则更新，没有被指定的列将用默认值替代
	 * @param unknown_type $table
	 * @param unknown_type $fields
	 */
	function replace($table, $fields){
		if (empty($table) || empty($fields)) return false;
		
		$tmp = array();
		foreach($fields as $k=>$v){
			$tmp[] = "$k='".$this->escapeMysqlString($v)."'";
		}
		$fieldStr = implode(",", $tmp);
		 
		$sql = sprintf(self::_SQL_REPLACE, $table, $fieldStr);
		$this->debug && print "sql = ".$sql."<br/>";
		return $this->_dbObj->query($sql);
	}
	
	
	/**
	 * 组织查询条件 ...
	 * @param array $wheres
	 * @return string
	 */
	function compareCondition($wheres = array()) {
		if (empty($wheres)) {
			return '1=1';
		}
		$condition = '1=1';

		foreach($wheres as $key => $value) {
			if ((strval($value) !== '0' && strval($value) == '') || $value == 'ALL') continue;
			$res = preg_match("/^([^_]+)_(.*)$/", $key, $matches);
			if ($matches[1] == 'eq') {
				$condition .= " and " . $matches[2] . "='$value'";
			} elseif($matches[1] == 'like') {
				$condition .= " and " . $matches[2] . " like '%$value%'";
			} elseif($matches[1] == 'lt') {
				$condition .= " and " . $matches[2] . " <= '$value'";
			} elseif($matches[1] == 'gt') {
				$condition .= " and " . $matches[2] . " >= '$value'";
			}
		}

		return $condition;
	}

	/**
	 * 组织 Limit ...
	 * @param number $page 当前页码
	 * @param number $pagesize 每页容量
	 * @return string
	 */
	function getLimit($page, $pagesize) {
		return ($page-1)*pagesize . $pagesize;
	}

	/**
	 * 获取分页导航 ...
	 * @param number $total 记录总数
	 * @param number $page 当前页
	 * @param number $pagesize 页容量
	 * @return string
	 */
	function getPageNav($total, $page, $pagesize = 20) {
		$url = Request::getFullPath();
		$url = preg_replace("/([-]*page-[0-9]*)/i", "", $url);
        $postfix = '';

        $strpos = strpos($url, '?');
        if($strpos !== false){
            $postfix = substr($url, $strpos);
            $url = substr($url, 0, $strpos);
        }
        if(substr($url, -1, 1) == '/'){
            $s = '';
        }else{
            $s = '/';
        }
		$s = strpos($url, '-') === FALSE ? $s : '-';
		$pages = ceil($total/$pagesize);
		$page = min($pages,$page);
		$prepg = $page-1;
		$nextpg = $page == $pages ? 0 : ($page+1);
		if($total < 1) return FALSE;


		$pagenav = '<li class="disabled"><a>总数：' . $total . ' 页码：' . $page . '/' . $pages . '</a></li>';
		$pagenav .= $prepg ? "<li><a href='$url{$s}page-1{$postfix}'>首页</a></li>" : '<li><a href="">首页</a></li>';
        for($i=-2; $i<=2; $i++){
            $pageTmp = $page+$i;
            if($pageTmp < 1 || $pageTmp > $pages){
                continue;
            }
            if($i != 0){
                $pagenav .= "<li><a href='$url{$s}page-$pageTmp{$postfix}'>$pageTmp</a></li>";
            }else if($i == 0){
                $pagenav .= "<li class='active'><a href='$url{$s}page-$pageTmp{$postfix}'>$pageTmp</a></li>";
            }
        }
		$pagenav .= $nextpg ? "<li><a href='$url{$s}page-$pages{$postfix}'>尾页</a></li>" : '<li><a href="">尾页</a></li>';

		return $pagenav;
	}
	
	public function escapeMysqlString($sqlString) {
		if (function_exists('mysql_escape_string')) {
			return @mysql_escape_string($sqlString);
		} else {
			return @mysql_real_escape_string($sqlString);
		} 
//		if(WEB_SERVER=='develop' || WEB_SERVER=='test'){
//			return $sqlString;
//		}
//		return mysql_escape_string($sqlString);
	}
		
	
}

?>