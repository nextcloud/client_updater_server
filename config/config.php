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

$rel = '2020-12-23 12:00';
$ver = '3.1.1';

$old_rel = '2020-10-30 12:00';
$old_ver = '3.0.3';

// in 90% of the cases ship the old version. Otherwise ship the current version.
if (rand(0, 9) !== 2) {
	$rel = $old_rel;
	$ver = $old_ver;
}

$ver_str = 'Nextcloud Client ' . $ver;

if (version_compare($version, '3.0.3') < 0) {
	$url = 'https://download.nextcloud.com/desktop/releases/';
	$linux_url = $url . 'Linux/';
	$windows_url = $url . 'Windows/';
	$mac_url = $url . 'Mac/Installer/';
} else {
	$url = 'https://github.com/nextcloud/desktop/releases/download/v' . $ver . '/';
	$linux_url = $url;
	$windows_url = $url;
	$mac_url = $url;
}

if (version_compare($version, '3.1.0') < 0) {
    $windows_suffix = '-setup.exe';
} else {
    if ($buildArch === 'i386') {
        $windows_suffix = '-x86.msi';
    } else {
        $windows_suffix = '-x64.msi';
    }
}


/**
 * Associative array of OEM => OS => version
 */
return [
	'Nextcloud' => [
		'release' => $rel,
		'linux' => [
			'version' => $ver,
			'versionstring' => $ver_str,
			'downloadurl' => $linux_url . 'Nextcloud-' . $ver . '-x86_64.AppImage',
			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
		'win32' => [
			'version' => $ver,
			'versionstring' => $ver_str,
			'downloadurl' => $windows_url . 'Nextcloud-' . $ver . $windows_suffix,
			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
		'macos' => [
			'version' => $ver,
			'versionstring' => $ver_str,
			'downloadurl' => $mac_url . 'Nextcloud-' . $ver . '.pkg',
			'web' => 'https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients',
		],
	],
];
