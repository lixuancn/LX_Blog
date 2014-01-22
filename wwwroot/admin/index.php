<?php
/**
 * 管理员管理
 * Created by Lane.
 * @Class Admin
 * @Author: lane
 * @Mail: lixuan868686@163.com
 */
class Index extends AdminController {

	public function __construct() {
        parent::__construct();
	}

    /**
     * @descrpition 首页
     */
    public function main(){

        View::showAdminTpl('index');
    }
}
?>