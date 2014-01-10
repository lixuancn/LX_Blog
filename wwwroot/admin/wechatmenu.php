<?php
/**
 * 微信自定义菜单
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-5
 * Time: 下午4:44
 */
class WeChatMenu extends AdminController{
    /**
     * @descrpition 向微信服务器提交添加
     */
    public function push(){
        $jumpurl = '/admin.php/wechatmenu/get';
        $menuList = WechatMenuBusiness::getWechatMenuList();
        $data = array('button'=>'');
        foreach ($menuList as $key => $menu){
            //取出一级菜单
            if($menu['pid'] == 0){
                $data['button'][$menu['id']]['type'] = $menu['type'];
                $data['button'][$menu['id']]['name'] = $menu['name'];
                if($menu['type'] == 'click'){
                    $data['button'][$menu['id']]['key'] = $menu['key_url'];
                }else if($menu['type'] == 'view'){
                    $data['button'][$menu['id']]['url'] = $menu['key_url'];
                }else{
                    View::showMessage($jumpurl, '出现未知的类型，请检查后再提交!');
                }
                unset($menuList[$key]);
                //取出二级菜单
                foreach ($menuList as $k => $second){
                    if($second['pid'] == $menu['id']){
                        $data['button'][$menu['id']]['sub_button']['type'] = $second['type'];
                        $data['button'][$menu['id']]['sub_button']['name'] = $second['name'];
                        if($second['type'] == 'click'){
                            $data['button'][$menu['id']]['sub_button']['key'] = $second['key_url'];
                        }else if($second['type'] == 'view'){
                            $data['button'][$menu['id']]['sub_button']['url'] = $second['key_url'];
                        }else{
                            View::showMessage($jumpurl, '出现未知的类型，请检查后再提交!');
                        }
                        unset($menuList[$k]);
                    }
                }
            }
        }
        $data = json_encode($data);
        $result = MenuBusiness::addMenu($data);
        if(isset($result['errcode']) && $result['errcode'] == 0){
            View::showMessage($jumpurl, '成功!');
        }else{
            $content =  $result['errmsg'];
            View::showErrorMessage($jumpurl, '出错了!'.$content);
        }
    }

    /**
     * @descrpition 向微信服务器提交清空
     */
    public function clear(){
        $jumpurl = '/admin.php/wechatmenu/get';
        $result = MenuBusiness::delMenu();
        if(isset($result['errcode']) && $result['errcode'] == 0){
            View::showMessage($jumpurl, '成功!');
        }else{
            $content =  $result['errmsg'];
            View::showErrorMessage($jumpurl, '出错了!'.$content);
        }
    }

    /**
     * @descrpition 添加
     */
    public function add(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/wechatmenu/add';
            $name = Request::getRequest('name', 'str');
            $type = Request::getRequest('type', 'str');
            $key_url = Request::getRequest('key_url', 'str');
            $pid = Request::getRequest('pid', 'str');
            $click_content = Request::getRequest('click_content', 'str');
            $fields = array(
                'type' => $type,
                'name' => $name,
                'key_url' => $key_url,
                'pid' => $pid,
                'click_content' => $click_content,
            );
            $result = WechatMenuBusiness::setWechatMenu($fields);
            if($result){
                View::showMessage($jumpurl, '成功!');
            }else{
                View::showErrorMessage($jumpurl, '出错了!');
            }
        }
        $menuList = array();
        $data = WechatMenuBusiness::getWechatMenuList();
        foreach ($data as $d){
            if($d['pid'] == 0){
                $menuList[] = $d;
            }
        }

        view::assign('menuList', $menuList);
        View::showAdminTpl('wechat_menu_add');
    }

    /**
     * @descrpition 获取
     */
    public function get(){
        $data = WechatMenuBusiness::getWechatMenuList();
//        $data = MenuBusiness::getMenuList();
        $menuList = array();
        foreach ($data as $d){
            $menuList[$d['id']] = $d;
        }
        view::assign('menuList', $menuList);
        View::showAdminTpl('wechat_menu_list');
    }

    /**
     * @descrpition 修改
     */
     public function edit(){
        $id = Request::getRequest('id', 'str');
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/wechatmenu/edit';
            $name = Request::getRequest('name', 'str');
            $type = Request::getRequest('type', 'str');
            $key_url = Request::getRequest('key_url', 'str');
            $pid = Request::getRequest('pid', 'str');
            $click_content = Request::getRequest('click_content', 'str');
            $fields = array(
                'type' => $type,
                'name' => $name,
                'key_url' => $key_url,
                'pid' => $pid,
                'click_content' => $click_content,
            );
            $result = WechatMenuBusiness::editWechatMenu($id, $fields);
            if($result){
                View::showMessage($jumpurl, '成功!');
            }else{
                View::showErrorMessage($jumpurl, '出错了!');
            }
        }
        $menuList = array();
        $data = WechatMenuBusiness::getWechatMenuList();
        foreach ($data as $d){
            if($d['pid'] == 0){
                $menuList[] = $d;
            }
        }
        $data = WechatMenuBusiness::getWechatMenuById($id);

        view::assign('menuList', $menuList);
        view::assign('data', $data);
        View::showAdminTpl('wechat_menu_edit');
    }

    /**
     * @descrpition 删除
     */
    public function del(){
        $jumpurl = '/admin.php/wechatmenu/get';
        $id = Request::getRequest('id', 'str');
        $result = WechatMenuBusiness::delWechatMenu($id);
        if($result){
            View::showMessage($jumpurl, '成功!');
        }else{
            View::showErrorMessage($jumpurl, '出错了!');
        }
    }


}