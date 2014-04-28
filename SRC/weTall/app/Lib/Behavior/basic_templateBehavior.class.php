<?php

defined('THINK_PATH') or exit();

class basic_templateBehavior extends Behavior {

    protected $options   =  array(
        'BASIC_THEME' => 'default', // 当前语言包
    );

    public function run(&$templateFile){
        // 自动定位模板文件
        if(!file_exists_case($templateFile)) {
            $templateFile   = $this->parseTemplateFile($templateFile);
        }   
    }

    /**
     * 自动定位模板文件
     * @access private
     * @param string $templateFile 文件名
     * @return string
     */
    private function parseTemplateFile($templateFile) {
        //var_dump($templateFile);
        if(''==$templateFile) {
            // 如果模板文件名为空 按照默认规则定位
            $templateFile = C('TEMPLATE_NAME');
            if(!file_exists_case($templateFile) && C('DEFAULT_THEME') && C('BASIC_THEME')) {
                //如果定义了主题，不存在则找项目缺省主题目录寻找
                $pin_default_theme = C('BASIC_THEME');
                $group = defined('GROUP_NAME') ? GROUP_NAME . '/' : '';
                $pin_theme_path = TMPL_PATH . $group . $pin_default_theme . '/';
                $templateFile = $pin_theme_path.MODULE_NAME.(defined('GROUP_NAME')?C('TMPL_FILE_DEPR'):'/').ACTION_NAME.C('TMPL_TEMPLATE_SUFFIX');
            }
        }elseif(false === strpos($templateFile,C('TMPL_TEMPLATE_SUFFIX'))){
            // 解析规则为 模板主题:模块:操作 不支持 跨项目和跨分组调用
            $path   =  explode(':',$templateFile);
            $action = array_pop($path);
            $module = !empty($path)?array_pop($path):MODULE_NAME;
            if(!empty($path)) {// 设置模板主题
                $path = dirname(THEME_PATH).'/'.array_pop($path).'/';
            }else{
                $path = THEME_PATH;
            }
            $depr = defined('GROUP_NAME')?C('TMPL_FILE_DEPR'):'/';
            $templateFile  =  $path.$module.$depr.$action.C('TMPL_TEMPLATE_SUFFIX');
            if(!file_exists_case($templateFile) && C('DEFAULT_THEME') && C('BASIC_THEME')) {
                //如果定义了主题，不存在则找项目缺省主题目录寻找
                $path = dirname(THEME_PATH) . '/' . C('BASIC_THEME') . '/';
                $templateFile = $path.$module.$depr.$action.C('TMPL_TEMPLATE_SUFFIX');
            }
        }
        if(!file_exists_case($templateFile)) {
            throw_exception(L('_TEMPLATE_NOT_EXIST_').'['.$templateFile.']');
        }
        return $templateFile;
    }

}