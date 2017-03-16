<?php

sleep(2);

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
	$sent = mail ('walsercl@gmx.ch','Betreff', 'Nachricht');
	var_dump($sent);
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
	if (!in_array("error", $response['fields'])) {
		if (sendForm($_POST)) {
			$response['sent'] = 'ok';
		}
	}
}

print(json_encode($response));

?>