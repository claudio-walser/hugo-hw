<?php

require 'vendor/autoload.php';

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

$response = array(
	'fields' => array(
		'name' => 'error',
		'email' => 'error',
		'phone' => 'error',
		'message' => 'error'
	),
	'sent' => 'error'
);

function stringIsValid($value) {
	return !empty(trim($value));
}

function numberIsValid($value) {
	return preg_match("/^[0-9\+\s]+$/", trim($value));
}

function emailIsValid($value) {
	return filter_var(trim($value), FILTER_VALIDATE_EMAIL);
}

function sendForm($data) {
	$sent = false;
	try {
		$httpClient = new GuzzleAdapter(new Client());
		$sparky = new SparkPost($httpClient, ['key'=>'spark-post-secret-key']);

		$promise = $sparky->transmissions->post([
		    'content' => [
		        'from' => [
		            'name' => 'SparkMailer',
		            'email' => 'hewal.rechtsberatung@gmail.com',
		        ],
		        'subject' => 'First Mailing in PHP',
		        'html' => '<html><body><h1>Congratulations, {{name}}!</h1><p>You just sent your very first mailing!</p></body></html>',
		        'text' => 'Congratulations, {{name}}!! You just sent your very first mailing!',
		    ],
		    'substitution_data' => ['name' => $data['name']],
		    'recipients' => [
		        [
		            'address' => [
		                'name' => 'Claudio Walser',
		                'email' => 'walsercl@gmx.ch',
		            ],
		        ],
		    ]
		]);
		print_r($promise);
		//$sent = true;
	} catch (Exception $e) {
		print($e->getMessage());
		print_r($e->getStackTrace());
	}
	return $sent;
}

if (!empty($_POST)) {
	if (stringIsValid($_POST['name'])) {
		$response['fields']['name'] = 'ok';
	}
	if (emailIsValid($_POST['email'])) {
		$response['fields']['email'] = 'ok';
	}
	if (numberIsValid($_POST['phone'])) {
		$response['fields']['phone'] = 'ok';
	}
	if (stringIsValid($_POST['message'])) {
		$response['fields']['message'] = 'ok';
	}
	if (!in_array("error", $response['fields'])) {
		if (sendForm($_POST)) {
			$response['sent'] = 'ok';
		}
	}
}

print(json_encode($response));

?>