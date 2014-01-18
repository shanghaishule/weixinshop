<?php

class pageModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '{%article_title_empty}'),
    );
    protected $_auto = array(
        array('last_time', 'time', 3, 'function'),
    );
}