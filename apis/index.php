<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-10
 * Time: 下午4:22
 */
class Index{
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
	
    /**
     * @descrpition 首页
     */
    public function main(){
        View::showFrontTpl('index');
    }
}

