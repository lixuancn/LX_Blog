<?php
/**
 * 管理后台控制器
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
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