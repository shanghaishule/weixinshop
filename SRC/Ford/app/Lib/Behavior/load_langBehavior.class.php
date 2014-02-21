<?php

defined('THINK_PATH') or exit();

class load_langBehavior extends Behavior {
    protected $options   =  array(
        'DEFAULT_LANG' => 'zh-cn', // 当前语言包
    );

    public function run(&$params){
        $lang = $group_lang = $module_lang = array();
        $lang_dir = LANG_PATH . C('DEFAULT_LANG');
        // 读取项目公共语言包
        if (is_file($lang_dir . '/common.php')) {
            $lang = include $lang_dir . '/common.php';
        }
        
        // 读取当前分组公共语言包
        if (defined('GROUP_NAME')) {
            $group_lang_file = $lang_dir . '/' . GROUP_NAME . '/common.php';
            if (is_file($group_lang_file)) {
                $group_lang = include $group_lang_file;
            }
        }
        // 读取当前模块语言包
        $module_lang_file = $lang_dir . '/' . GROUP_NAME . '/' . MODULE_NAME . '.php';
        if (is_file($module_lang_file)) {
            $module_lang = include $module_lang_file;
        }
        $lang = array_merge($lang, $group_lang, $module_lang);

        $js_lang = isset($lang['js_lang']) ? $lang['js_lang'] : array();
        $module_js_lang = isset($lang['js_lang_' . MODULE_NAME]) ? $lang['js_lang_' . MODULE_NAME] : array();
        $lang['js_lang'] = array_merge($js_lang, $module_js_lang);
        L($lang);
    }
}