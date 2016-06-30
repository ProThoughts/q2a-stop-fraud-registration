<?php

class qa_stop_fraud_registration {

	function option_default($option) {
		switch($option) {
			case 'qa_stop_fraud_registration_hours':
				return 1;
			case 'qa_stop_fraud_registration_max_registers':
				return 5;
			default:
				return null;
		}
	}

	function allow_template($template) {
		return ($template != 'admin');
	}

	function admin_form(&$qa_content){
		// process the admin form if admin hit Save-Changes-button
		$ok = null;
		if (qa_clicked('qa_stop_fraud_registration_save')) {
			qa_opt('qa_stop_fraud_registration_hours', (int)qa_post_text('qa_stop_fraud_registration_hours'));
			qa_opt('qa_stop_fraud_registration_max_registers', (int)qa_post_text('qa_stop_fraud_registration_max_registers'));
			$ok = qa_lang('admin/options_saved');
		}

		// form fields to display frontend for admin
		$fields = array();

		$fields[] = array(
			'type' => 'number',
			'label' => qa_lang('qa_stop_fraud_registration/within_hours'),
			'tags' => 'NAME="qa_stop_fraud_registration_hours"',
			'value' => qa_opt('qa_stop_fraud_registration_hours'),
		);

		$fields[] = array(
			'type' => 'number',
			'label' => qa_lang('qa_stop_fraud_registration/max_registers'),
			'tags' => 'NAME="qa_stop_fraud_registration_max_registers"',
			'value' => qa_opt('qa_stop_fraud_registration_max_registers'),
		);

		return array(
			'ok' => ($ok && !isset($error)) ? $ok : null,
			'fields' => $fields,
			'buttons' => array(
				array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'name="qa_stop_fraud_registration_save"',
				),
			),
		);
	}

	function process_event($event, $userid, $handle, $cookieid, $params)
	{
		if ($event === 'u_register' || $event === 'u_login') {
			error_log('event:' . $event);
			error_log('userid:' . $userid);
			error_log('handle:' . $handle);
			error_log('ipaddress:' . qa_remote_ip_address());
		}
	}

	function count_regist_number($ipaddress, $hour)
	{
		$sql = "
SELECT count(*)
 FROM ^eventlog
 WHERE event = 'u_login'
 AND ipaddress =  $
 AND DATETIME > ( NOW( ) - INTERVAL # HOUR ) 
";
		return 0;
	}
}
