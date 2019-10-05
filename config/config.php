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
		'linux' => [
			'version' => '2.6.0',
			'versionstring' => 'Nextcloud Client 2.6.0',
			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
		'win32' => [
			'version' => '2.6.0',
			'versionstring' => 'Nextcloud Client 2.6.0',
			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
		'macos' => [
			'version' => '2.2.4.1',
			'versionstring' => 'Nextcloud Client 2.2.4 (build 1)',
			'downloadUrl' => 'https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-2.2.4.1.pkg.tbz',
			'signature' => 'MCwCFGC3X/fejC/y/3T2X+c8ldDk7pJGAhQoR8v6vtvvV57nIcMNePA+jNRYcw==',
		],
	],
];
