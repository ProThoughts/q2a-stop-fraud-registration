<?php

/*
	Plugin Name: Stop Fraud Registration
	Plugin URI:
	Plugin Description: To stop the new user registration When register more than a certain number within a set time
	Plugin Version: 1.0
	Plugin Date: 2016-06-30
	Plugin Author:38qa.net
	Plugin Author URI:
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.7
	Plugin Update Check URI:
*/

	return array(
		// japanese
		'within_hours' => '何時間以内に:',
		'max_registers' => '上記時間内にこの人数を超えた場合新規登録を停止する<br>人数:',
		'mail_subject' => qa_opt('site_title') . ' 新規ユーザー登録を停止しました',
		'mail_body' => "下記IPアドレスからの登録が規定回数を超えましたので\n新規ユーザー登録を停止いたしました。",
	);


/*
	Omit PHP closing tag to help avoid accidental output
*/
