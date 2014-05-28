<?php
/**
 * 用户当前步骤定义.执行之前
 *
 * Created by Lane.
 * @Class StepConstant
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class StepConstant{

    const STEP_INIT = 0; //顶层

    const STEP_CHOICE_GAME = 1; //第1步，选择游戏

    const STEP_CHOICE_PLATFORM = 2; //第2步，选择平台

    const STEP_SPECIFIC_OPERATION = 3; //第3步，选择具体操作后，如发送礼包等

    const STEP_INPUT_USERNAME = 4; //第4步，输入帐号

    const STEP_INPUT_PASSWORD = 5; //第5步，输入密码

    const STEP_OPERATION_ING = 6; //第6步，具体操作正在进行
}