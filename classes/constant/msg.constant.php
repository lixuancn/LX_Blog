<?php
/**
 * 错误码常量
 * Created by Lane.
 * @Class MsgConstant
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class MsgConstant{

    //-------系统错误相关--101 到200 ------
    const ERROR_SYSTEM = 101; //系统错误
    const ERROR_NEWS_ITEM_COUNT_MORE_TEN = 102; //图文消息的项数超过10
    const ERROR_USER_ILLEGAL_OPERATION = 103; //非法操作

    //-------用户输入相关--1001到1100------
    const ERROR_INPUT_ERROR = 1001; //输入有误，请重新输入
    const ERROR_UNKNOW_TYPE = 1002; //收到了未知类型的消息
    const ERROR_CAPTCHA_ERROR = 1003; //验证码错误
    const ERROR_REQUIRED_FIELDS = 1004; //必填项未填写全

    //-------远程调用相关--1201到1300------
    const ERROR_REMOTE_SERVER_NOT_RESPOND = 1201; //远程服务器未响应
    const ERROR_GET_ACCESS_TOKEN = 1202; //获取ACCESS_TOKEN失败

    //-------文章管理相关--1301到1400------
    const ERROR_ARTICLE_NOT_EXISTS = 1301; //文章不存在

    //-------分类管理相关--1401到1500------
    const ERROR_MENU_NOT_EXISTS = 1401; //菜单不存在
}