<?php
/**
 * Created by Lane.
 * @Class NeedConstant
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class NeedConstant{

    //----------------------收到文本时---------------------

    const NEED_PROJECT = 1; //需要用户发送项目
    const NEED_PLATFORM = 2; //需要用户发送平台
    const NEED_OPERATION = 3; //需要用户发送操作
    const NEED_USERNAME = 4; //需要用户发送用户名
    const NEED_PASSWORD = 5; //需要用户发送密码

    //----------------------收到图像时---------------------

    const NEED_IMAGE = 6;

    //----------------------收到语音时---------------------

    const NEED_VOICE = 7;

    //----------------------收到视频时---------------------

    const NEED_VIDEO = 8;

    //----------------------收到地理时---------------------

    const NEED_LOCATION = 9;

    //----------------------收到链接时---------------------

    const NEED_LINK = 10;

    //----------------------收到关注时---------------------

    const NEED_EVENT_SUBSCRIBE = 11;

    //----------------------收到取消关注时---------------------

    const NEED_EVENT_UNSUBSCRIBE = 12;

    //----------------------收到扫描二维码关注（未关注时）时---------------------

    const NEED_EVENT_QRSCENE_SUBSCRIBE = 13;

    //----------------------收到扫描二维码（已关注时）时---------------------

    const NEED_EVENT_SCAN = 14;

    //----------------------收到上报地理位置时---------------------

    const NEED_EVENT_LOCATION = 15;

    //----------------------收到自定义菜单时---------------------

    const NEED_EVENT_CLICK = 16;
}