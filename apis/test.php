<?php 
class Test extends Controller{
    public function getMenuList(){
//        $menuList = MenuBusiness::getMenuList();
        $menuList = array();
        $menuList[] = array('id'=>1, 'name'=>'谁是卧底', 'description'=>'谁是卧底游戏描述');
        $menuList[] = array('id'=>2, 'name'=>'心有灵犀', 'description'=>'依次上场，每队两人。一个人比划一个人猜。猜词过程中，不许说出词条中包含的任何字，否则该词条作废，根据词条难度，有三次选择放弃的机会。');

        $ret = array();
        $ret['data'] = $menuList;
        $ret['errCode'] = $menuList ? 0 : 1;
        $ret['errMsg'] = $menuList ? '' : '获取列表失败';
        echo json_encode($ret);
    }

    public function getGameRuleForUndercover(){
        $rule = <<<RULE
【游戏规则】
1.在场8人中7人拿到同一词语，剩下1人拿到与之相关的另一词语。
2.每人每轮用一句话描述自己拿到的词语，既不能让卧底察觉，也要给同伴以暗示。
3.每轮描述完毕，所有在场的人投票选出怀疑谁是卧底，得票最多的人出局。若没有人的得票超过半数（50%），则没有人出局。若卧底出局，则游戏结束。若卧底未出局，游戏继续。
4.反复2-3流程。若卧底撑到最后一轮（场上剩3人时），则卧底获胜，反之，则大部队胜利。
【游戏词语】
1、尽量选择共同点多的词语。例如干洗机和甩干机，相机和摄影机，打火机和点烟器等等。
2、但是一定要有区分度，不然会造成死局（即所有人盲投票或不投票）
【游戏经验】
1、当每个人拿到词语后，需要快速确认自己是否是卧底。
2、如果是卧底，要猜到普通人的词，说出类似的词，从而混淆视听，保证生存能力。
3、如果是普通人，既不能说的模棱两可也不能说的非常明确，也就是说让同伴认得出，让卧底猜不出
RULE;

        $ret = array();
        $ret['data'] = $rule;
        $ret['errCode'] = $rule ? 0 : 1;
        $ret['errMsg'] = $rule ? '' : '获取列表失败';
        echo json_encode($ret);
    }
}
