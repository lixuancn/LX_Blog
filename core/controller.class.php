<?php
/**
 * 控制基本类.
 * @author: Administrator <weiming2@staff.sina.com.cn>
 * @date: 2011-6-26 
 * @version $Id: controller.class.php 2 2013-06-05 10:21:56Z manling $
 */

class AdminController {
	
	/**
	 * 加载模型，并初始化模型对象 ...
	 * @param string $file
	 * @return object
	 */
	function loadModel($file, $useCache = false) {
		$modelFile = ADMIN_MODEL_PATH . strtolower($file) . '.class.php';
		$cacheModelFile = ADMIN_MODEL_PATH . 'cache.' . strtolower($file) . '.class.php';
		if (!file_exists($modelFile)) {
			exit("Model File $modelFile not exits!");
		}
		require_once $modelFile;
		if (file_exists($cacheModelFile) && $useCache) {
			require_once $cacheModelFile;
			$filename = "Cache" . ucfirst($file) . "Model";
		} else {
			$filename = ucfirst($file) . "Model";
		}
		
		$modelObj = new $filename();
		return $modelObj; 
	}
}

?>