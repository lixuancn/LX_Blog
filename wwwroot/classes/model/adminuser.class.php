<?php
/**
 * 管理员相关
 * @Class AdminUserDbModel
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class AdminUserModel extends DbModel{

    protected $_tableName = 'admin_user';

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public function add($fields){
        return $this->insertOne($this->_tableName, $fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     * @return bool
     */
    public function edit($id, $fields){
        $where = "`id` = '".$id."'";
        return $this->update($this->_tableName, $fields, $where);
    }

    /**
     * @descrpition 删除数据
     * @param $id
     * @return bool
     */
    public function del($id){
        $where = "`id` = '".$id."'";
        return $this->deleteOne($this->_tableName, $where);
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function get($id){
        $where = "`id` = '".$id."'";
        $fields = '*';
        return $this->selectOne($this->_tableName, $where, $fields);
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function getByUsername($username){
        $where = "`username` = '".$username."'";
        $fields = '*';
        return $this->selectOne($this->_tableName, $where, $fields);
    }

    /**
     * @descrpition 获取列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getList() {
        $where = 1;
        $fields = '*';
        $order = '`id` ASC';
        return $this->selectList($this->_tableName, $where, $fields, $order);
    }
}