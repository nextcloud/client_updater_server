<?php
/**
 * SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Response.php';

// Set Content-Type to XML
header('Content-Type: application/xml');
// Enforce browser based XSS filters
header('X-XSS-Protection: 1; mode=block');
// Disable sniffing the content type for IE
header('X-Content-Type-Options: nosniff');
// Disallow iFraming from other domains
header('X-Frame-Options: Sameorigin');
// https://developers.google.com/webmasters/control-crawl-index/docs/robots_meta_tag
header('X-Robots-Tag: none');

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
	isset($_SERVER['PATH_INFO']) &&
	substr($_SERVER['PATH_INFO'], -5) === '/hook' &&
	isset($_SERVER['HTTP_X_HUB_SIGNATURE']) &&
	isset($_SERVER['HTTP_X_GITHUB_EVENT']) &&
	$_SERVER['HTTP_X_GITHUB_EVENT'] === 'push') {

	if (!file_exists(__DIR__ . '/config/secrets.php')) {
		exit();
	}
	try {
		$config = new \ClientUpdateServer\Config(__DIR__ . '/config/secrets.php');
	} catch (\RuntimeException $e) {
		exit();
	}
	$webhookSecret = $config->get('githubWebhookSecret');
	$branch = $config->get('githubWebhookBranch');
	if (!is_string($webhookSecret) || !is_string($branch)) {
		exit();
	}

	$body = file_get_contents('php://input');
	$expectedSecretHeader = $_SERVER['HTTP_X_HUB_SIGNATURE'];
	$actualSecret = 'sha1=' . hash_hmac('sha1', $body, $webhookSecret);

	if ($actualSecret !== $expectedSecretHeader) {
		exit();
	}

	$data = json_decode($body, true);

	if (!is_array($data)) {
		exit();
	}

	if (isset($data['ref']) && $data['ref'] === 'refs/heads/' . $branch) {
		$escapedDir = escapeshellarg(__DIR__);
		exec("cd $escapedDir && git pull && composer update --no-dev");
		echo "Deployed";
	}

	exit();
}

$allowedChannels = ['stable', 'daily', 'beta', 'enterprise'];

// Read parameters
$oem = isset($_GET['oem']) ? (string)$_GET['oem'] : null;
$platform = isset($_GET['platform']) ? (string)$_GET['platform'] : null;
$buildArch = isset($_GET['buildArch']) ? (string)$_GET['buildArch'] : "x86_64";
$currentArch = isset($_GET['currentArch']) ? (string)$_GET['currentArch'] : "x86_64";
$version = isset($_GET['version']) ? (string)$_GET['version'] : null;
$isSparkle = isset($_GET['sparkle']) ? true : false;
$isFileProvider = isset($_GET['fileprovider']) ? true : false;
// due to a bug in an old version, the channels were translated. we need to catch them again
$channel = isset($_GET['channel']) && in_array($_GET['channel'], $allowedChannels, true)
	? $_GET['channel']
	: 'stable';

$osRelease = isset($_GET['osRelease']) ? (string)$_GET['osRelease'] : '';
$osVersion = isset($_GET['osVersion']) ? (string)$_GET['osVersion'] : '';
$kernelVersion = isset($_GET['kernelVersion']) ? (string)$_GET['kernelVersion'] : '';

if($oem === null || $platform === null || $version === null) {
	die();
}

$config = require_once __DIR__ . '/config/config.php';

// Deliver update
$response = new \ClientUpdateServer\Response(
	$oem,
	$platform,
	$version,
	$osRelease,
	$osVersion,
	$kernelVersion,
	$channel,
	$isSparkle,
	$isFileProvider,
	$config
);
echo $response->buildResponse();
