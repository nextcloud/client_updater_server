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

$stableReleaseDate = '2023-01-20 10:00';
$stableVersion = '3.6.6';

$betaReleaseDate = '2023-01-30 23:00';
$betaVersionInternal = '3.6.91';
$betaVersion = '3.7.0-rc1';

$stableVersionString = 'Nextcloud Client ' . $stableVersion;
$betaVersionString = 'Nextcloud Client ' . $betaVersion;

if (version_compare($version, '3.0.3') < 0) {
	$url = 'https://download.nextcloud.com/desktop/releases/';
	$stable_linux_url = $url . 'Linux/';
	$stable_windows_url = $url . 'Windows/';
	$stable_mac_url = $url . 'Mac/Installer/';
} else {
	$stableUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $stableVersion . '/';
	$stable_linux_url = $stableUrl;
	$stable_windows_url = $stableUrl;
	$stable_mac_url = $stableUrl;

	$betaUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $betaVersion . '/';
	$beta_linux_url = $betaUrl;
	$beta_windows_url = $betaUrl;
	$beta_mac_url = $betaUrl;
}

if (version_compare($version, '3.1.0') < 0) {
    $windows_suffix = '-setup.exe';
    $stableVersion = '3.1.3';
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
		'stable' => [
			'release' => $stableReleaseDate,
			'linux' => [
				'version' => $stableVersion,
				'versionstring' => $stableVersionString,
				'downloadurl' => $stable_linux_url . 'Nextcloud-' . $stableVersion . '-x64.AppImage',
				'web' => 'https://nextcloud.com/install',
			],
			'win32' => [
				'version' => $stableVersion,
				'versionstring' => $stableVersionString,
				'downloadurl' => $stable_windows_url . 'Nextcloud-' . $stableVersion . $windows_suffix,
				'web' => 'https://nextcloud.com/install',
			],
			'macos' => [
				'version' => $stableVersion,
				'versionstring' => $stableVersionString,
				'downloadurl' => $stable_mac_url . 'Nextcloud-' . $stableVersion . '.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $stable_mac_url . 'Nextcloud-' . $stableVersion . '.pkg.tbz',
				"signature" => "O6ydFZ5F3BrgLGbkdrhnmag0IOfuvXw+drgsTyi7B9Jpyt3eNEkyhXsPHZaaUeaTaRTiBqEBL8LM7/WqOUy+Cw==",
				"length" => 61356612
			],
		],
		'beta' => [
			'release' => $betaReleaseDate,
			'linux' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $beta_linux_url . 'Nextcloud-' . $betaVersion . '-x64.AppImage',
				'web' => 'https://nextcloud.com/install',
			],
			'win32' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $beta_windows_url . 'Nextcloud-' . $betaVersion . $windows_suffix,
				'web' => 'https://nextcloud.com/install',
			],
			'macos' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $beta_mac_url . 'Nextcloud-' . $betaVersion . '.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $beta_mac_url . 'Nextcloud-' . $betaVersion . '.pkg.tbz',
				"signature" => "9EXwd28hrC3SOltWtgm7jYkICwXMqi7utKLyVWNrs7HG/TbeMiFhfgXrNfy9AnE8TfU4kLNGhDbuhczBtBf5AA==",
				"length" => 62637725
			],
		]
	]
];
