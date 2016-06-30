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
		// default
		'within_hours' => 'Within hours:',
		'max_registers' => 'Max Registars:',
		'mail_subject' => qa_opt('site_title') . ' Stopped New Registration',
		'mail_body' => 'This IP address has exceeded the registration, it has stopped the user new registration.',
	);


/*
	Omit PHP closing tag to help avoid accidental output
*/
