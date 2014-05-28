<?php
/**
 *
 * 错误码类.
 *
 * Created by Lane.
 * @Class: ErrorCodeDbModel
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class ErrorCodeDbModel extends DbModel {
    const MC_ERROR_CODE_LIST = 'info_error_code_list';

    const MC_ERROR_CODE_NUM = 'info_error_code_info_';

    protected $_tableName = 'info_error_code';

    public function get($code, $real=false) {
//        $data = Mcache::get(self::MC_ERROR_CODE_NUM . $code);
//        if ($real || !$data) {
            $data = $this->getReal($code);
//        }
        return $data;
    }

    public function getReal($code) {
        $data = $this->selectOne($this->_tableName, "code='$code'", "*");
//        if ($data) {
//            Mcache::set(self::MC_ERROR_CODE_NUM . $code, $data);
//        }
        return $data;
    }

    public function getList($real=false) {
//        $data = Mcache::get(self::MC_ERROR_CODE_LIST);

//        if ($real || !$data) {
            $data = $this->getListReal();
//        }

        return $data;
    }

    public function getListReal() {
        $data = $this->selectList($this->_tableName, '1');

//        if ($data) {
//            Mcache::set(self::MC_ERROR_CODE_LIST, $data);
//        }

        return $data;
    }

    function getErrorCodeInfo($code) {
        if (empty($code)) return false;

        return $this->selectOne($this->_tableName, "code='$code'", "*");
    }

    function addErrorCode($info=array()) {
        if (empty($info) || empty($info['code'])) return false;

        return $this->insertOne($this->_tableName, $info);
    }

    function updateErrorCode($code, $info=array()) {
        if (empty($code) || empty($info)) return false;

        return $this->update($this->_tableName, $info, "code='$code'");
    }

    function deleteErrorCode($code) {
        if (empty($code)) return false;

        return $this->deleteOne($this->_tableName, "code='$code'");
    }

    /**
     * 清除相关的MC
     */
    public function cleanMc(){
        $list = $this->getList(true);
        foreach( $list as $key=>$value ){
//            Mcache::delete(self::MC_ERROR_CODE_NUM . $value['code']);
        }
//        Mcache::delete(self::MC_ERROR_CODE_LIST);
        return $list;
    }
}