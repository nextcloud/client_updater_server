<?php
/**
 * @copyright Copyright (c) 2016 Lukas Reschke <lukas@statuscode.ch>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

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
		exec("cd $escapedDir && git pull");
		echo "Deployed";
	}

	exit();
}

// Read parameters
$oem = isset($_GET['oem']) ? (string)$_GET['oem'] : null;
$platform = isset($_GET['platform']) ? (string)$_GET['platform'] : null;
$buildArch = isset($_GET['buildArch']) ? (string)$_GET['buildArch'] : "x86_64";
$currentArch = isset($_GET['currentArch']) ? (string)$_GET['currentArch'] : "x86_64";
$version = isset($_GET['version']) ? (string)$_GET['version'] : null;
$isSparkle = isset($_GET['sparkle']) ? true : false;
$updateSegment = isset($_GET['updatesegment']) ? (int)$_GET['updatesegment'] : -1;
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
	$isSparkle,
	$updateSegment,
	$osRelease,
	$osVersion,
	$kernelVersion,
	$config
);
echo $response->buildResponse();
