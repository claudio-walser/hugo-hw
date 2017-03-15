<?php


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
	return !empty(trim($value));
}

function emailIsValid($value) {
	return !empty(trim($value));
}

function sendForm($data) {

	return true;
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

	if (sendForm($_POST)) {
		$response['sent'] = 'ok';
	}
}

print(json_encode($response));

?>