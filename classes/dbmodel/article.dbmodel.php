<?php
/**
 * 文章model层
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-3
 * Time: 下午10:01
 */
class ArticleDbModel extends DbModel{

    const MC_ARTICLE_INFO = 'mc_article_info_';

    const MC_ARTICLE_LIST = 'mc_article_list';

    const MC_ARTICLE_PROJECT_LIST = 'mc_article_project_list_';

    protected $_tableName = 'info_article';

    /**
     * @descrpition 添加数据
     * @param $data
     */
    public function add($fields){
//        Mcache::delete(self::MC_ARTICLE_LIST);
        return $this->insertOne($this->_tableName, $fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     * @return bool
     */
    public function edit($id, $fields){
//        Mcache::delete(self::MC_ARTICLE_LIST);
        $where = "`id` = '".$id."'";
        return $this->update($this->_tableName, $fields, $where);
    }

    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function get($id, $real=false){
//        $data = Mcache::get(self::MC_ARTICLE_INFO . $id);
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
//            Mcache::set(self::MC_ARTICLE_INFO . $id, $data);
        }
        return $data;
    }
    /**
     * @descrpition 获取单条记录
     * @param int $id
     * @param bool $real
     * @return bool|multitype
     */
    public function getByMid($mid, $real=false){
//        $data = Mcache::get(self::MC_ARTICLE_INFO . $id);
//        if(!$data || $real){
        $data = $this->getByMidReal($mid);
//        }
        return $data;
    }

    public function getByMidReal($mid){
        $where = "`mid` = '".$mid."'";
        $fields = '*';
        $order = '`ctime` DESC';
        $data = $this->selectList($this->_tableName, $where, $fields, $order);
        if($data){
//            Mcache::set(self::MC_ARTICLE_INFO . $id, $data);
        }
        return $data;
    }
    /**
     * @descrpition 获取列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getList($real=false) {
//        $data = Mcache::get(self::MC_ARTICLE_LIST);
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
//            Mcache::set(self::MC_ARTICLE_LIST, $data);
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
//            Mcache::delete(self::MC_ARTICLE_INFO . $value['id']);
//            Mcache::delete(self::MC_ARTICLE_PROJECT_LIST . $value['project_id']);
        }
//        Mcache::delete(self::MC_ARTICLE_LIST);
        return $list;
    }
}