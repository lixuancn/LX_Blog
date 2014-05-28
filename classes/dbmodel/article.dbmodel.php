<?php
/**
 *
 * 文章model层
 *
 * Created by Lane.
 * @Class ArticleDbModel
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */
class ArticleDbModel extends DbModel{

    const MC_ARTICLE_INFO = 'mc_article_info_';

    const MC_ARTICLE_LIST = 'mc_article_list';

    const MC_ARTICLE_MENU = 'mc_article_menu_';

    const MC_ARTICLE_NEW_LIST = 'mc_article_new_list';

    const MC_ARTICLE_HOT_LIST = 'mc_article_hot_list';

    const MC_ARTICLE_HOT = 'mc_article_hot_';

    protected $_tableName = 'info_article';

    /**
     * @descrpition 添加数据
     * @param $data
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
//        Mcache::delete(self::MC_ARTICLE_INFO . $id);
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
    public function getByMid($mid, $page, $real=false){
//        $data = Mcache::get(self::MC_ARTICLE_MENU . $mid . '_' . $page);
//        if(!$data || $real){
        $data = $this->getByMidReal($mid, $page);
//        }
        return $data;
    }

    public function getByMidReal($mid, $page){
        $where = "`mid` = '".$mid."'";
        $fields = '*';
        $order = '`ctime` DESC';
        $data = $this->selectPageList($this->_tableName, $where, $page, ParamConstant::PARAM_PAGE_SIZE, $fields, $order);
        if($data){
//            Mcache::set(self::MC_ARTICLE_MENU . $mid . '_' . $page, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getList($page=1, $real=false) {
//        if ($real || !$data){
        $data = $this->getListReal($page);
//        }
        return $data;
    }

    public function getListReal($page) {
        $where = 1;
        $fields = '*';
        $order = '`ctime` DESC';
        $data = $this->selectPageList($this->_tableName, $where, $page, ParamConstant::PARAM_PAGE_SIZE, $fields, $order);
        if ($data) {
//            Mcache::set(self::MC_ARTICLE_LIST . $mid . '_' . $page, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取最新列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getNewList($real=false){
//        $data = Mcache::get(self::MC_ARTICLE_NEW_LIST);
//        if ($real || !$data){
        $data = $this->getNewListReal();
//        }
        return $data;
    }

    public function getNewListReal() {
        $where = 1;
        $fields = '*';
        $order = '`ctime` DESC';
        $limit = '0, 10';
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->_tableName . ' WHERE ' . $where . ' ORDER BY ' . $order . ' LIMIT ' . $limit;
        $data = $this->customSelect($sql);
        if ($data) {
//            Mcache::set(self::MC_ARTICLE_NEW_LIST, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取最热列表
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getHotList($real=false){
//        $data = Mcache::get(self::MC_ARTICLE_HOT_LIST);
//        if ($real || !$data){
        $data = $this->getHotListReal();
//        }
        return $data;
    }

    public function getHotListReal() {
        $where = 1;
        $fields = '*';
        $order = '`clicks` DESC';
        $limit = '0, 5';
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->_tableName . ' WHERE ' . $where . ' ORDER BY ' . $order . ' LIMIT ' . $limit;
        $data = $this->customSelect($sql);
        if ($data) {
//            Mcache::set(self::MC_ARTICLE_HOT_LIST, $data);
        }
        return $data;
    }

    /**
     * @descrpition 获取最热列表ByMid
     * @param bool $real
     * @return Ambigous|bool
     */
    public function getHotListByMid($mid, $real=false){
//        $data = Mcache::get(self::MC_ARTICLE_HOT . $mid);
//        if ($real || !$data){
        $data = $this->getHotListByMidReal($mid);
//        }
        return $data;
    }

    public function getHotListByMidReal($mid) {
        $where = "`mid` = '" . $mid . "'";
        $fields = '*';
        $order = '`clicks` DESC';
        $limit = '0, 5';
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->_tableName . ' WHERE ' . $where . ' ORDER BY ' . $order . ' LIMIT ' . $limit;
        $data = $this->customSelect($sql);
        if ($data) {
//            Mcache::set(self::MC_ARTICLE_HOT . $mid, $data);
        }
        return $data;
    }

    /**
     * Description: 根据标题和关键词搜索文章
     * @param $keyowrd
     * @param int $page
     * @return Ambigous
     */
    public function search($keyowrd, $page=1){
        $where = "`title` LIKE '%" . $keyowrd . "%'";
        $fields = '*';
        $order = '`id` DESC';
        return $this->selectPageList($this->_tableName, $where, $page, ParamConstant::PARAM_PAGE_SIZE, $fields, $order);

    }

    /**
     * Description: 点击数+1
     * @param $keyowrd
     * @param int $page
     * @return Ambigous
     */
    public function clicks($articleId){
        $where = "`id` = '".$articleId."'";
        $sql = 'UPDATE `'.$this->_tableName.'` SET `clicks` = `clicks` + 1 WHERE ' . $where;
        return $this->customQuery($sql);
    }

    /**
     * Description: 同意数+1
     * @return Ambigous
     */
    public function goodNum($articleId){
        $where = "`id` = '".$articleId."'";
        $sql = 'UPDATE `'.$this->_tableName.'` SET `good_num` = `good_num` + 1 WHERE ' . $where;
        return $this->customQuery($sql);
    }

    /**
     * Description: 反对数+1
     * @return Ambigous
     */
    public function badNum($articleId){
        $where = "`id` = '".$articleId."'";
        $sql = 'UPDATE `'.$this->_tableName.'` SET `bad_num` = `bad_num` + 1 WHERE ' . $where;
        return $this->customQuery($sql);
    }

    public function getAllList(){
        $fields = '`id`, `ctime`';
        $where = 1;
        return $this->selectList($this->_tableName, $where, $fields, '`id` DESC');
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
        }
//        Mcache::delete(self::MC_ARTICLE_NEW_LIST);
//        Mcache::delete(self::MC_ARTICLE_LIST);
        return $list;
    }
}