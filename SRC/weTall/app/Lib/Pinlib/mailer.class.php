<?php
/**
 * 邮件处理
 *
 * @author andery
 */
class mailer
{

    private static $mailer_server = array();
    // mailer对象
    public $mailer;
    public $debug = false;
    public $timeout = 30;
    // 错误信息
    public $errors = array();

    /**
     * 构造函数
     * @param array $mailer_gw
     * @return void;
     */
    public function __construct($mailer_gw) {
        vendor("PHPMailer.class#phpmailer");
        $this->mailer = new PHPMailer();
        $this->mailer->SetLanguage('zh_cn');
        if (!isset($mailer_gw['Mailer']) || $mailer_gw['Mailer'] == 'mail') {
            $this->mailer->IsMail();
        } else {
            $mailer_gw = $this->initGw($mailer_gw);
            foreach ($mailer_gw as $key=>$val) {
                $this->mailer->$key = $val;
            }
        }
    }

    /**
     * 单例
     */
    public function get_instance($name = '') {
        if (!isset(self::$mailer_server[$name])) {
            $mail_config = !empty($name) ? C('pin_mail_server_'.$name) : C('pin_mail_server');
            $mailer_gw = array(
                'Mailer'=>$mail_config['mode'],
                'From' => $mail_config['from'],
                'FromName' => $mail_config['from_name'],
                'Host' => $mail_config['host'],
                'Port' => $mail_config['port'],
                'Username' => $mail_config['auth_username'],
                'Password' => $mail_config['auth_password'],
            );
            return self::$mailer_server[$name] = new self($mailer_gw);
        } else {
            return self::$mailer_server[$name];
        }
    }

    /**
     * 发送邮件方法
     * @param mixed $toaddress 收件人地址
     *        需要收件人姓名：$toaddress = arary('$name'=>'@email')
     * @param string $subject 邮件标题
     * @param string $body 邮件主题
     * @param string $charset 编码方式
     * @param bool $is_html 是否html格式
     * @param mixed $attachs 附件
     *        需要附件名：$attachs = arary('$name'=>'$file')
     * @return boolean
     */
    public function send($toaddress, $subject, $body, $charset='utf-8', $is_html=true, $attachs = false) {
        //$this->mailer->Priority  = $this->priority; //邮件优先级
        $this->mailer->CharSet   = $charset;
        $this->mailer->IsHTML($is_html);
        $this->mailer->Subject   = $subject;
        $this->mailer->Body      = $body;
        $this->mailer->timeout = $this->timeout;
        $this->mailer->SMTPDebug = $this->debug;
        if ($attachs) {
            $this->mailer->ClearAttachments();//清除历史附件
            if (is_array($attachs)) {
                foreach ($attachs as $name=>$file) {
                    $this->mailer->AddAttachment($file, $name);
                }
            } else {
                $this->mailer->AddAttachment($attachs, $attachs);
            }
        }

        $this->mailer->ClearAddresses(); //清除历史收件人
        if (is_array($toaddress)) {
            foreach ($toaddress as $name=>$mail) {
                $this->mailer->AddAddress($mail, $name);
            }
        } else {
            $this->mailer->AddAddress($toaddress);
        }
        $send_result = $this->mailer->Send();
        $this->errors[] = $this->mailer->ErrorInfo;
        return $send_result;
    }

    /**
     * 初始化邮件发送网关信息
     * @param array $mailer_gw
     * @return arrray
     */
    private function initGw($mailer_gw) {
        // 初始化网关信息
        $init_gw = array(
            'Mailer'=>'mail',
            'From' => '',
            'FromName' => 'pinphp.com',
            'Host' => 'localhost',
            'Port' => '25',
            'SMTPAuth' => true,
            'Username' => '',
            'Password' => '',
            'Timeout' => 30,
            'SMTPDebug' => false,
        );
        if (is_array($mailer_gw)) {
            // 避免引入phpmailer以外属性名造成错误，先取交集
            $mailer_gw = array_intersect_key($mailer_gw, $init_gw);
            return array_merge($init_gw, $mailer_gw);
        } else {
            return false;
        }
    }
}