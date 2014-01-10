<?php
/**
 * 返回FLASH提示信息类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2012-8-27
 * @version $Id: msg.common.php 1616 2013-11-28 11:46:36Z manling $
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
		$errorCodeInfo = self::getErrorCodeInstance()->get($code);
		if (empty($errorCodeInfo)) {
			$returnMsg['error_msg'] = '错误码不存在('.$code.')';
			$returnMsg['show_type'] = 1;
		} else {
			$returnMsg['error_msg'] = $errorCodeInfo['msg'];
			$returnMsg['show_type'] = $errorCodeInfo['type'];
		}
		if (!empty($errorMsg)) {
			$returnMsg['custom_msg'] = $errorMsg;
		}
        if(!empty($request)){
            $returnMsg['custom_msg'] .= '。';
            $returnMsg['custom_msg'] = MosaicBusiness::mosaicContent($returnMsg['custom_msg']);
            exit( ResponsePassiveBusiness::text($request['fromusername'], $request['tousername'], $returnMsg['custom_msg']));
        }else{
            $returnMsg['custom_msg'] = '出错啦！'.$returnMsg['custom_msg'];
            exit($returnMsg['custom_msg']);
        }
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