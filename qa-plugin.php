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

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

// language file
qa_register_plugin_phrases('qa-stop-fraud-registration-lang-*.php', 'qa_stop_fraud_registration');
// event
qa_register_plugin_module('event', 'qa-stop-fraud-registration.php', 'qa_stop_fraud_registration', 'Stop Fraud Registration');
