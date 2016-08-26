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
 * Associiative array of OEM => OS => version
 */
return [
	'Nextcloud' => [
		'linux' => [
			'version' => '2.2.2',
			'versionstring' => 'Nextcloud Client 2.2.2',
			'web' => 'https://nextcloud.com/install/#install-clients',
		],
		'win32' => [
			'version' => '2.2.3.4',
			'versionstring' => 'Nextcloud Client 2.2.3 (build 4)',
			'downloadUrl' => 'https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-2.2.3.4-setup.exe',
			'web' => 'https://nextcloud.com/install/#install-clients',
		],
		'macos' => [
			'version' => '2.2.3.4',
			'versionstring' => 'Nextcloud Client 2.2.3 (build 4)',
			'downloadUrl' => 'https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-2.2.3.4.pkg.tbz',
			'signature' => 'MC4CFQCPtGMiNjpLVd7YUBn3SGwGOyIwiwIVAIHOzliQeJTiq5STcFD1iJyXgThw',
		],
	],
];
