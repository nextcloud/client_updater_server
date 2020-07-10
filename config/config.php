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
		'release' => '2020-07-10 19:00',
		'linux' => [
			'version' => '2.6.5',
			'versionstring' => 'Nextcloud Client 2.6.5',
			'web' => 'https://download.nextcloud.com/desktop/releases/Linux/Nextcloud-2.6.5-x86_64.AppImage',
		],
		'win32' => [
			'version' => '2.6.5',
			'versionstring' => 'Nextcloud Client 2.6.5',
			'web' => 'https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-2.6.5-setup.exe',
		],
		'macos' => [
			'version' => '2.6.5',
			'versionstring' => 'Nextcloud Client 2.6.5',
			'downloadUrl' => 'https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-2.6.5.20200710.pkg.tbz',
			'signature' => 'MCwCFCNLFE8e7yka1LqJs6tPa7c2ZBxUAhR6Yp4rK0plJdg56mncXXnLOJ5grA==',

			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
	],
];
