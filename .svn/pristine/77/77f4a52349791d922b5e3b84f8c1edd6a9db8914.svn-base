<?php
/**
 * 表单封装类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-4 
 * @version $Id: form.lib.php 1 2013-05-30 06:40:35Z manling $
 */

class Form {
	public static function select_option($array, $selected='') {
		$option = '';
		foreach($array as $key => $value) {
			if ($key == $selected) {
				$option .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
			} else {
				$option .= '<option value="'.$key.'">'.$value.'</option>';
			}
		}
		
		return $option;
	}
}

?>