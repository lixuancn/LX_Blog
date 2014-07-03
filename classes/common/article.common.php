<?php
/**
 * 文章公共函数类
 * Created by PhpStorm.
 * User: lixuan-it
 * Date: 14-7-2
 * Time: 上午11:13
 */
class ArticleCommon{
    public static function replaceRecommendType($recommendType){
        switch($recommendType){
            //全站推荐
            case ParamConstant::PARAM_ARTICLE_RECOMMEND_TYPE_ALL_SITE:
                $name = '全站推荐';
                break;
            //首页推荐
            case ParamConstant::PARAM_ARTICLE_RECOMMEND_TYPE_INDEX:
                $name = '首页推荐';
                break;
            default:
                $name = '';
                break;
        }
        //返回
        $data = array();
        $data['name'] = $name;
        return $data;
    }
}