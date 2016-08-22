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

// Read parameters
$oem = isset($_GET['oem']) ? (string)$_GET['oem'] : null;
$platform = isset($_GET['platform']) ? (string)$_GET['platform'] : null;
$version = isset($_GET['version']) ? (string)$_GET['version'] : null;
$isSparkle = isset($_GET['sparkle']) ? true : false;

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
	$config
);
echo $response->buildResponse();
