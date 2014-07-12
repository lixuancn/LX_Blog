<?php
/**
 * 友情链接管理
 * Created by Lane.
 * @Class Menu
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class FriendLink extends AdminController{
    /**
     * @descrpition 构造函数
     */
    public function __construct($param=array()){
        parent::__construct($param);
    }

    /**
     * @descrpition 列表
     */
    public function lists(){
        $friendLinkList = FriendLinkBusiness::getFriendLinkList();
        View::assign('friendLinkList', $friendLinkList);
        View::showAdminTpl('friend_link_list');
    }

    /**
     * @descrpition 添加
     */
    public function add(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/friendlink/add/';
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            $fields['nofollow'] = Request::getRequest('nofollow', 'int');
            if(empty($fields['name'])){
                View::showAdminErrorMessage($jumpUrl, '未填写完成');
            }
            $result = FriendLinkBusiness::setFriendLink($fields);
            if($result){
                View::showAdminMessage('/admin.php/friendlink/lists', '添加成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '添加失败');
            }
        }
        $friendLinkList = FriendLinkBusiness::getFriendLinkList();
        View::assign('friendLinkList', $friendLinkList);
        View::showAdminTpl('friend_link_add');
    }

    /**
     * @descrpition 修改
     */
    public function edit(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/friendlink/edit/id-'.$this->param['id'];
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            $fields['nofollow'] = Request::getRequest('nofollow', 'int');
            if(empty($fields['name'])){
                View::showAdminErrorMessage($jumpUrl, '未填写完成');
            }
            $result = FriendLinkBusiness::editFriendLink($this->param['id'], $fields);
            if($result){
                View::showAdminMessage('/admin.php/friendlink/lists', '添加成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '添加失败');
            }
        }
        $friendLink = FriendLinkBusiness::getFriendLink($this->param['id']);
        View::assign('friendLink', $friendLink);
        View::showAdminTpl('friend_link_edit');
    }

    /**
     * @descrpition 删除
     */
    public function delete(){
        FriendLinkBusiness::delFriendLink($this->param['id']);
        View::showAdminMessage('/admin.php/friendlink/lists', "删除分类成功!");
    }
}