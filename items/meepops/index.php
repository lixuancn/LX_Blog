<?php
/**
 * 子项目 - 首页
 * Created by PhpStorm.
 * User: lane
 * Date: 16-5-27
 * Time: 下午22:47
 * E-mail: lixuan868686@163.com
 * WebSite: http://www.lanecn.com
 */
class Index extends Controller{
    /**
     * 构造函数
     */
    public function __construct($param=array()){
        parent::__construct($param);
    }

    /**
     * 首页
     */
    public function main(){
        View::showFrontTpl('index');
    }
}