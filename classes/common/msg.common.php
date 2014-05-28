<?php
/**
 * 返回FLASH提示信息类.
 * Created by Lane.
 * @Class MsgCommon
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */

class MsgCommon {
	private static $errorCodeObj;
	
	public static function getErrorCodeInstance() {
		if (is_null(self::$errorCodeObj) || !isset(self::$errorCodeObj)) {
			self::$errorCodeObj = new ErrorCodeDbModel();
		}
		return self::$errorCodeObj;
	}
	
	/**
	 * 返回错误信息 ...
	 * @param int $code 错误码
	 * @param string $errorMsg 错误信息
	 * @return Ambigous <multitype:unknown , multitype:, boolean>
	 */
	public static function returnErrMsg($code,  $errorMsg = null, $request=array()) {
		$returnMsg = array('error_code' => $code);
        $returnMsg['custom_msg'] = '出错啦！'.$errorMsg;
        return $returnMsg['custom_msg'] . '('.$returnMsg['error_code'].')';
	}

	/**
	 * 调用成功返回信息 ...
	 * @param unknown_type $data 返回的数据
	 * @return unknown
	 */
	public static function returnSucMsg($data = array()) {
		return $data;
	}
}
?>