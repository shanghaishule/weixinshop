<?php
/**
 * 短信状态说明
 * 0: 未读
 * 1：已读
 * 2：发送者已删除
 * 3：接收者已删除
 */
class messageModel extends Model
{
    //自动完成
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );

    /**
     * 用户删除信息
     */
    public function user_delete($mid, $uid) {
        $mids = is_array($mid) ? $mid : explode(',', $mid);
        if (!$mid || !$uid) {
            return false;
        }
        $delete_ids = array();
        foreach ($mids as $mid) {
            $info = $this->find($mid);
            if ($info['from_id'] == 0 && $info['to_id'] == $uid) {
                //系统发给用户的可以直接删除记录
                $delete_ids[] = $mid;
            } elseif ($info['to_id'] == $uid) {
                //收件箱
                if ($info['status'] == 2) {
                    //如果发送方已经删除则删除记录
                    $delete_ids[] = $mid;
                } else {
                    //修改状态为接收者删除
                    $this->where(array('id'=>$mid))->setField('status', 3);
                }
            } elseif ($info['from_id'] == $uid) {
                //发件箱
                if ($info['status'] == 3) {
                    //如果接收方已经删除则删除记录
                    $delete_ids[] = $mid;
                } else {
                    //修改状态为发送者删除
                    $this->where(array('id'=>$mid))->setField('status', 2);
                }
            } else {
                continue;
            }
        }
        return $delete_ids ? $this->delete(implode(',', $delete_ids)) : count($mids);
    }

    function setName($id,$value)
    {
        if( $id&&$value ){
            $map = array(
                'from_id' => $id,
                'from_name' => $value,
            );
            $this->where(array('from_id'=>$id))->save($map);

            $map2 = array(
                'to_id' => $id,
                'to_name' => $value,
            );
            $this->where(array('to_id'=>$id))->save($map);
        }
    }
}