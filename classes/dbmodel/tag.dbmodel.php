<?php
/**
 *
 * Tag
 *
 * Created by Lane.
 * @Class TagDbModel
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-2-19
 * @Time: 下午3:22
 */
class TagDbModel extends DbModel{

    const MC_TAG_INFO = 'mc_tag_info_';

    const MC_TAG_LIST = 'mc_tag_list';

    protected $_tableName = 'info_tag';

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public function add($fields){
//        Mcache::delete(self::MC_TAG_LIST);
        return $this->insertOne($this->_tableName, $fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     * @return bool
     */
    public function edit($id, $fields){
//        Mcache::delete(self::MC_TAG_INFO . $id);
//        Mcache::delete(self::MC_TAG_LIST);
        $where = "`id` = '".$id."'";
        return $this->update($this->_tableName, $fields, $where);
    }

    /**
     * @descrpition 删除数据
     * @param $id
     * @return bool
     */
    public function del($id){
//        Mcache::delete(self::MC_TAG_LIST);
//        Mcache::delete(self::MC_TAG_INFO . $id);
        $where = "`id` = '".$id."'";
        return $this->deleteOne($this->_tableName, $where);
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function get($id, $real=false){
//        $data = Mcache::get(self::MC_TAG_INFO . $id);
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
//            Mcache::set(self::MC_TAG_INFO . $id, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function getByTag($tag, $real=false){
        $data = $this->getByTagReal($tag);
        return $data;
    }

    public function getByTagReal($tag){
        $where = "`tag` = '".$tag."'";
        $fields = '*';
        $data = $this->selectOne($this->_tableName, $where, $fields);
        return $data;
    }

    /**
     * @descrpition 获取列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getList($real=false) {
//        $data = Mcache::get(self::MC_TAG_LIST);
//        if ($real || !$data){
        $data = $this->getListReal();
//        }
        return $data;
    }

    public function getListReal() {
        $where = 1;
        $fields = '*';
        $order = '`id` ASC';
        $data = $this->selectList($this->_tableName, $where, $fields, $order);
        if ($data) {
//            Mcache::set(self::MC_TAG_LIST, $data);
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
     * @descrpition 清楚MC
     * @return Ambigous|bool
     */
    public function cleanMc(){
        $list = $this->getList(true);
        foreach( $list as $value ){
//            Mcache::delete(self::MC_TAG_INFO . $value['id']);
        }
//        Mcache::delete(self::MC_TAG_LIST);
        return $list;
    }
}