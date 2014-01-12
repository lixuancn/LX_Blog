<?php
/**
 * 站内搜索页面
 * Class Article
 * Created by Lane.
 * Author: lane
 * Mail lixuan868686@163.com
 * Date: 14-1-10
 * Time: 下午4:22
 */
class Search extends Controller{
	/**
	 * 构造函数
	 */
	public function __construct($param=array()){
		parent::__construct($param);
	}
	
	/**
     * @descrpition 搜索
     */
    public function main(){
    	if(isset($this->param['keywords'])){
    		$keywords = $this->param['keywords'];
    		View::assign('keywords', $keywords);
    	}
    	
    	
        View::showFrontTpl('search');
    }
}