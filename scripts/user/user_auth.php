#!/usr/bin/env php
<?php

$root = dirname(dirname(dirname(__FILE__)));
require_once $root.'/scripts/__init_script__.php';

if ($argc !== 2) {
	echo "usage: user_auth.php <username>\n";
	exit(1);
}

$username = $argv[1];

$table = new PhabricatorUser();

if (!PhabricatorUser::validateUsername($username)) {
	$valid = PhabricatorUser::describeValidUsername();
	echo "The username '{$username}' is invalid. {$valid}\n";
	exit(1);
}

$user = id(new PhabricatorUser())->loadOneWhere(
	'username = %s', $username);

if (!$user) {
	echo "There is no existing user account '{$username}'.\n";
	exit(1);
}

if (!$user->isUserActivated()) {
	echo "Account is disabled!\n";
	exit(1);
}

$changed_pass = false;
// This disables local echo, so the user's password is not shown as they type
// it.
phutil_passthru('stty -echo');
$password = phutil_console_prompt("Enter password:");
phutil_passthru('stty echo');

echo "\n";

if (!strlen($password)) {
	echo "Invalid password.\n";
	exit(1);
}

$envelope = new PhutilOpaqueEnvelope($password);
if (!$user->comparePassword($envelope)) {
	echo "Invalid password.\n";
	exit(1);
}

echo "User can login!\n";
exit(0);
