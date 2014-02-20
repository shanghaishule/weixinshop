<?php

class badwordModel extends Model
{

    protected $_auto = array (array('add_time','time',1,'function'));

    /**
     * 检测敏感词
     * $word_type 0:合法  1:禁用  2:替换  3:审核
     */
    public function check($content) {
        $result = array('code'=>0, 'content'=>$content);
        if (!$content) {
            return $result;
        }
        //先分词再检测(取500个词)
        $words = D('tag')->get_tags_by_title($content, 500);
        !$words && $words = $content;
        $badwords = $this->field('word_type,badword,replaceword')->where(array('badword'=>array('IN', $words)))->order('word_type')->select();
        //合法就直接返回
        if (!$badwords) {
            return $result;
        }
        foreach ($badwords as $val) {
            //禁用也直接返回
            if ($val['word_type'] == 1) {
                $result['code'] = 1;
                return $result;
            }
            //替换
            if ($val['word_type'] == 2) {
                $result['content'] = str_replace($val['badword'], $val['replaceword'], $result['content']);
            }
            //审核
            if ($val['word_type'] == 3) {
                $result['code'] = 3;
            }
        }
        return $result;
    }

    /**
     * 是否存在
     */
    public function name_exists($name, $id=0)
    {
        $pk = $this->getPk();
        $where = "badword='" . $name . "'  AND ". $pk ."<>'" . $id . "'";
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}