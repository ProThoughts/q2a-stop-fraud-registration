<?php

require_once QA_PLUGIN_DIR.'q2a-stop-fraud-registration/sfr-send-mail.php';

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
		if ($event === 'u_register') {
			$max_count = qa_opt('qa_stop_fraud_registration_max_registers');
			$hour = qa_opt('qa_stop_fraud_registration_hours');
			// $ipaddress = qa_remote_ip_address();
			qa_db_user_login_sync(false);
			$count = $this->count_regist_number($hour);
			qa_db_user_login_sync(true);
			if ($count > $max_count) {
				qa_opt('suspend_register_users', 1);
				sfr_send_mail::setup();
				sfr_send_mail::send();
			}
		}
	}

	function count_regist_number($hour = null)
	{
		if ($hour < 0) {
			return 0;
		}

		$sql = "
SELECT count(*) as regist_count
 FROM ^users
 WHERE created > ( NOW() - INTERVAL # HOUR )
";
		$query = qa_db_query_sub($sql, $hour);
		$result = qa_db_read_one_assoc($query);
		return $result['regist_count'];
	}
}
