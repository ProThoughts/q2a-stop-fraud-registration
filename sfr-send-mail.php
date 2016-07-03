<?php
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

require_once QA_INCLUDE_DIR.'qa-app-options.php';
require_once QA_INCLUDE_DIR.'qa-app-emails.php';

class sfr_send_mail
{
	public static $params;

	public static function setup()
	{
		self::$params = array();
		self::$params['fromemail'] = qa_opt('from_email');
		self::$params['fromname'] = qa_opt('site_title');
		self::$params['toemail'] = qa_opt('feedback_email');
		self::$params['subject'] = qa_lang('qa_stop_fraud_registration/mail_subject');
		self::$params['toname'] = '管理人';
		self::$params['body'] = qa_lang('qa_stop_fraud_registration/mail_body') . "\n\n";
		self::$params['html'] = false;
	}

	public static function send()
	{
		qa_send_email(self::$params);
	}

}
