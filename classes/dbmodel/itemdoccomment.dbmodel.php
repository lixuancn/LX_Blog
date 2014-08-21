<?php
/**
 *
 * 评论model层
 *
 * @Class CommentDbModel
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class ItemDocCommentDbModel extends DbModel{

    const MC_COMMENT_INFO = 'mc_comment_info_';

    const MC_COMMENT_LIST = 'mc_comment_list';

    const MC_COMMENT_NEW_LIST = 'mc_comment_new_list';

    const MC_COMMENT_AID = 'mc_comment_aid_';

    const MC_COMMENT_NEW = 'mc_comment_new_';

    protected $_tableName = 'info_item_doc_comment';

    /**
     * @descrpition 添加数据
     * @param $data
     */
    public function add($fields){
//        Mcache::delete(self::MC_COMMENT_LIST);
        return $this->insertOne($this->_tableName, $fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     * @return bool
     */
    public function edit($id, $fields){
//        Mcache::delete(self::MC_COMMENT_LIST);
        $where = "`id` = '".$id."'";
        return $this->update($this->_tableName, $fields, $where);
    }

    /**
     * @descrpition 删除数据
     * @param $id
     * @return bool
     */
    public function del($id){
//        Mcache::delete(self::MC_COMMENT_LIST);
//        Mcache::delete(self::MC_COMMENT_INFO . $id);
        $where = "`id` = '".$id."'";
        return $this->deleteOne($this->_tableName, $where);
    }

    /**
     * @descrpition 删除数据
     * @param $id
     * @return bool
     */
    public function delByAid($aid){
//        Mcache::delete(self::MC_COMMENT_LIST);
//        Mcache::delete(self::MC_COMMENT_INFO . $id);
        $where = "`aid` = '".$aid."'";
        return $this->deleteList($this->_tableName, $where);
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function get($id, $real=false){
//        $data = Mcache::get(self::MC_COMMENT_INFO . $id);
//        if(!$data || $real){
        $data = $this->getReal($id);
//        }
        return $data;
    }

    public function getReal($id){
        $where = "`id` = '".$id."'";
        $fields = '*';
        $data = $this->selectOne($this->_tableName, $where, $fields);
        if($data){
//            Mcache::set(self::MC_COMMENT_INFO . $id, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function getByAid($aid, $item, $real=false){
//        $data = Mcache::get(self::MC_COMMENT_AID . $aid);
//        if(!$data || $real){
        $data = $this->getByAidReal($aid, $item);
//        }
        return $data;
    }

    public function getByAidReal($aid, $item){
        $where = "`aid` = '".$aid."' AND `item` = '".$item."'";
        $fields = '*';
        $order = '`id` ASC';
        $data = $this->selectList($this->_tableName, $where, $fields, $order);
        if($data){
//            Mcache::set(self::MC_COMMENT_AID . $aid, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getList($real=false) {
//        $data = Mcache::get(self::MC_COMMENT_LIST);
//        if ($real || !$data){
        $data = $this->getListReal();
//        }
        return $data;
    }

    public function getListReal() {
        $where = 1;
        $fields = '*';
        $order = '`ctime` DESC';
        $data = $this->selectList($this->_tableName, $where, $fields, $order);
        if ($data) {
//            Mcache::set(self::MC_COMMENT_LIST, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取最新
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getNewList($real=false){
//        $data = Mcache::get(self::MC_COMMENT_NEW_LIST);
//        if ($real || !$data){
        $data = $this->getNewListReal();
//        }
        return $data;
    }

    public function getNewListReal() {
        $where = 1;
        $fields = '*';
        $order = '`ctime` DESC';
        $limit = '0, 5';
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->_tableName . ' WHERE ' . $where . ' ORDER BY ' . $order . ' LIMIT ' . $limit;
        $data = $this->customSelect($sql);
        if ($data) {
//            Mcache::set(self::MC_COMMENT_NEW_LIST, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取最新ByMid
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getNewListByMid($mid, $real=false){
//        $data = Mcache::get(self::MC_COMMENT_NEW . $mid);
//        if ($real || !$data){
        $data = $this->getNewListByMidReal($mid);
//        }
        return $data;
    }

    public function getNewListByMidReal($mid) {
        $where = "`mid` = '" . $mid . "'";
        $fields = '*';
        $order = '`ctime` DESC';
        $limit = '0, 5';
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->_tableName . ' WHERE ' . $where . ' ORDER BY ' . $order . ' LIMIT ' . $limit;
        $data = $this->customSelect($sql);
        if ($data) {
//            Mcache::set(self::MC_COMMENT_NEW . $mid, $data);
        }
        return $data;
    }

    /**
     * @descrpition 静态数据
     * @return array
     */
    public function getStaticData() {
        $ret = array();
        $list = $this->cleanMc();
        foreach($list as $value){
            $tmp = $value;
            $ret[$value['id']] = $tmp;
        }
        return $ret;
    }

    /**
     * 获取带分页的全部评论列表
     */
    public function getCommentListPage($page){
        $where = 1;
        $order = "`ctime` DESC";
        $pageSize = 20;
        $field = "*";
        return $this->selectPageList($this->_tableName, $where, $page, $pageSize, $field, $order);
    }

    /**
     * @descrpition 清楚MC
     * @return Ambigous|bool
     */
    public function cleanMc(){
        $list = $this->getList(true);
        foreach( $list as $value ){
//            Mcache::delete(self::MC_COMMENT_INFO . $value['id']);
        }
//        Mcache::delete(self::MC_COMMENT_LIST);
        return $list;
    }
}