<?php
/**
 * 前台控制器基本类
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-10
 * Time: 下午4:22
 */
class Controller{
	/**
	 * 本类接收到的实例化时的参数
	 * @param $param
	 */
	protected $param;
	
	/**
	 * 
	 * 构造函数
	 * @param $param 实例化时传入的参数
	 */
	public function __construct($param=array()){
		$this->param = $param;
	}
}