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

$rel = '2020-09-28 18:00';
$ver = '3.0.2';

$ver_str = 'Nextcloud Client ' . $ver;

$url = 'https://github.com/nextcloud/desktop/releases/download/v' . $ver . '/';

/**
 * Associative array of OEM => OS => version
 */
return [
	'Nextcloud' => [
		'release' => $rel,
		'linux' => [
			'version' => $ver,
			'versionstring' => $ver_str,
			'web' => $url . 'Nextcloud-' . $ver . '-x86_64.AppImage',
		],
		'win32' => [
			'version' => $ver,
			'versionstring' => $ver_str,
			'web' => $url . 'Nextcloud-' . $ver . '-setup.exe',
		],
		'macos' => [
			'version' => $ver,
			'versionstring' => $ver_str,
			'web' => $url . 'Nextcloud-' . $ver . '.pkg',
		],
	],
];
