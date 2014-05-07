#!/usr/bin/env php
<?php

$root = dirname(dirname(dirname(__FILE__)));
require_once $root.'/scripts/__init_script__.php';

if (isset($_ENV["PAM_USER"])) {
	$username = $_ENV["PAM_USER"];
} else {
	if ($argc !== 2) {
		echo "usage: user_auth.php <username>\n";
		exit(1);
	}

	$username = $argv[1];
}

if (isset($_ENV["PAM_AUTHTOK"])) {
	$password = $_ENV["PAM_AUTHTOK"];
} else {
	phutil_passthru('stty -echo');
	$password = phutil_console_prompt("Enter password:");
	phutil_passthru('stty echo');
	echo "\n";
}

$table = new PhabricatorUser();

if (!PhabricatorUser::validateUsername($username)) {
	echo "x1 Login failed!\n";
	exit(1);
}

$user = id(new PhabricatorUser())->loadOneWhere(
	'username = %s', $username);

if (!$user) {
	echo "x2 Login failed!\n";
	exit(1);
}

if (!$user->isUserActivated()) {
	echo "x3 Login failed!\n";
	exit(1);
}

if (!strlen($password)) {
	echo "x4 Login failed!\n";
	exit(1);
}

$envelope = new PhutilOpaqueEnvelope($password);
if (!$user->comparePassword($envelope)) {
	echo "x5 Login failed!\n";
	exit(1);
}

echo "Login ok!\n";
exit(0);
