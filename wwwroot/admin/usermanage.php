<?php
/**
 * 用户管理
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-5
 * Time: 下午7:18
 */
class UserManage{

    //-----------------------------组--------------管-------------理----------------------

    /**
     * @descrpition 创建分组
     */
    public function createGroup(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/usermanage/createGroup';
            $groupName = Request::getRequest('groupName', 'str');
            if(empty($groupName)){
                View::showErrorMessage($jumpurl, '信息未填写完！');
            }
            $result = UserManageBusiness::createGroup($groupName);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                $result = json_decode($result, true);
                //保存分组
                GroupBusiness::addGroup($result['group']);
            }
        }
        View::showAdminTpl('usermanage_group_add');
    }

    /**
     * @descrpition 获取分组
     */
    public function getGroupList(){
        $jumpurl = '/admin.php/usermanage/getGroupList';
        $result = UserManageBusiness::getGroupList();
        if(isset($result['errcode']) && $result['errcode'] != 0){
            $content =  $result['errmsg'];
            View::showErrorMessage($jumpurl, '出错了!'.$content);
        }else{
            $groups = json_decode($result['groups'], true);
            View::assign('groups', $groups);
        }
        View::showAdminTpl('usermanage_group_list');
    }

    /**
     * @descrpition 查询用户所在分组
     */
    public function getGroupByOpenId(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/usermanage/getGroupByOpenId';
            $openId = Request::getRequest('openId', 'str');
            if(empty($openId)){
                View::showErrorMessage($jumpurl, '信息未填写完！');
            }
            $result = UserManageBusiness::getGroupByOpenId($openId);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                $result = json_decode($result, true);
                $group = GroupBusiness::getGroupById($result['groupid']);
                View::assign('group', $group);
            }
        }
        View::showAdminTpl('usermanage_group_user');
    }

    /**
     * @descrpition 修改分组名
     */
    public function editGroupName(){
        $groupId = Request::getRequest('groupId', 'str');
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/usermanage/editGroupName';
            $groupName = Request::getRequest('groupName', 'str');
            if(empty($groupId) || empty($groupName)){
                View::showErrorMessage($jumpurl, '信息未填写完！');
            }
            $result = UserManageBusiness::editGroupName($groupId, $groupName);
            if(isset($result['errcode']) && $result['errcode'] == 0){
                $fields['name'] = $groupName;
                $group = GroupBusiness::edit($groupId, $fields);
                View::assign('group', $group);
            }else{
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }
        }
        $group = GroupBusiness::getGroupById($groupId);
        View::assign('group', $group);
        View::showAdminTpl('usermanage_group_edit');
    }

    /**
     * @descrpition 移动用户分组
     */
    public function editUserGroup(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/usermanage/editUserGroup';
            $openId = Request::getRequest('openId', 'str');
            $to_groupId = Request::getRequest('to_groupId', 'str');
            if(empty($openId) || empty($to_groupId)){
                View::showErrorMessage($jumpurl, '信息未填写完！');
            }
            $result = UserManageBusiness::editUserGroup($openId, $to_groupId);
            if(isset($result['errcode']) && $result['errcode'] == 0){
                //修改用户分组
                $fields = array('group_id'=>$to_groupId);
                UserBusiness::edit($openId, $fields);
            }else{
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }
        }
        $groupList = GroupBusiness::getGroupList();
        View::assign('groupList', $groupList);
        View::showAdminTpl('usermanage_group_user_edit');
    }

    //-----------------------------用-------户-------管--------理----------------------

    /**
     * @descrpition 获取用户信息
     */
    public function getUserInfo(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/usermanage/getUserInfo';
            $openId = Request::getRequest('openId', 'str');
            if(empty($openId)){
                View::showErrorMessage($jumpurl, '信息未填写完！');
            }
            $result = UserManageBusiness::getUserInfo($openId);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                $result = json_decode($result, true);
                if($result['subscribe'] == 1){
                    $result['subscribe'] = '是';
                }
                if($result['sex'] == 1){
                    $result['sex'] = '男';
                }else if($result['sex'] == 2){
                    $result['sex'] = '女';
                }else{
                    $result['sex'] = '未知';
                }
                $result['subscribe_time'] = date('Y-m-d H:i:s', $result['subscribe_time']);
                View::assign('userInfo', $result);
            }
        }
        View::showAdminTpl('usermanage_user_info');
    }

    /**
     * @descrpition 获取关注者列表
     */
    public function getFansList(){
        $next_openid = Request::getRequest('next_openid', 'str', '');
        $jumpurl = '/admin.php/usermanage/getFansList';
        $result = UserManageBusiness::getFansList($next_openid);
        if(isset($result['errcode']) && $result['errcode'] != 0){
            $content =  $result['errmsg'];
            View::showErrorMessage($jumpurl, '出错了!'.$content);
        }else{
            $result = json_decode($result, true);
            View::assign('userInfoList', $result);
        }
        View::showAdminTpl('usermanage_user_list');
    }
}