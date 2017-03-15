<?php

$response = array(
	"name" => 'error',
	"email" => 'error',
	'phone' => 'error',
	'message' => 'error'
);

function stringIsValid($value) {
	return !empty(trim($value));
}

function emailIsValid($value) {
	return !empty(trim($value));
}

if (!empty($_POST)) {
	if (stringIsValid($_POST['name'])) {
		$response['name'] = 'ok';
	}
	if (emailIsValid($_POST['email'])) {
		$response['email'] = 'ok';
	}
	if (stringIsValid($_POST['phone'])) {
		$response['phone'] = 'ok';
	}

	if (stringIsValid($_POST['message'])) {
		$response['message'] = 'ok';
	}
}

print(json_encode($response));

?>