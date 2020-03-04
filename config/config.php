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

/**
 * Associative array of OEM => OS => version
 */
return [
	'Nextcloud' => [
		'release' => '2020-03-04 03:43',
		'linux' => [
			'version' => '2.6.4',
			'versionstring' => 'Nextcloud Client 2.6.4',
			'web' => 'https://download.nextcloud.com/desktop/releases/Linux/Nextcloud-2.6.4-x86_64.AppImage',
		],
		'win32' => [
			'version' => '2.6.4',
			'versionstring' => 'Nextcloud Client 2.6.4',
			'web' => 'https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-2.6.4-setup.exe',
		],
		'macos' => [
			'version' => '2.6.4',
			'versionstring' => 'Nextcloud Client 2.6.4',
			'downloadUrl' => 'https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-2.6.4.20200303.pkg.tbz',
			'signature' => 'MC0CFFa6a1hWAjxsVrlIHbANvoCyqzHbAhUAoM3QJRzMQWxdmsZx6huddqcqKz4=',

			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
	],
];
