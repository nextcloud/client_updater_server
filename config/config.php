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

$stableReleaseDate = '2024-04-24 14:00';
$stableVersion = '3.13.0';
$fileProviderStableReleaseDate = '2024-04-24 14:00';
$fileProviderStableVersion = '3.13.0';

$betaReleaseDate = '2024-04-13 15:00';
$betaVersionInternal = '3.12.81';
$betaVersion = '3.13.0-rc1';

$dailyReleaseDateLinux = '20240706';
$dailyReleaseDateWindows = '20240707';
$dailyReleaseDateMacos = '20240604';
$dailyUrl = "https://download.nextcloud.com/desktop/daily/";

$stableVersionString = 'Nextcloud Client ' . $stableVersion;
$fileProviderStableVersionString = 'Nextcloud Client ' . $fileProviderStableVersion;
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
				"fileProviderVersionString" => $fileProviderStableVersionString,
				'downloadurl' => $stable_mac_url . 'Nextcloud-' . $stableVersion . '.pkg',
				'fileProviderDownloadUrl' => $stable_mac_url . 'Nextcloud-' . $fileProviderStableVersion . '-macOS-vfs.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $stable_mac_url . 'Nextcloud-' . $stableVersion . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $stable_mac_url . 'Nextcloud-' . $fileProviderStableVersion . '-macOS-vfs.pkg.tbz',
				"signature" => "PiIm4QHCGj3cQcr4K4mX30qUl+NUwM0hvQmpu30UE7iagM4Tq3vPQRfFywwYHMurfSav6rpckhhbyNjmZoCqDA==",
				"fileProviderSignature" => "mHJDtEbZDnWElr2MQa44kEHp6wOwbPae+CYyLZbueeFuT+K8Us3icimrcQ8uBU1vb0UNay5j6L+dVhf9VO8qBw==",
				"length" => 64617546,
				"fileProviderLength" => 97313419,
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
				// 'fileProviderDownloadUrl' => $beta_mac_url . 'Nextcloud-macOS-vfs-' . $betaVersion . '.pkg',  TODO: 3.13.0
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $beta_mac_url . 'Nextcloud-' . $betaVersion . '.pkg.tbz',
				// "fileProviderSparkleDownloadUrl" => $beta_mac_url . 'Nextcloud-macOS-vfs-' . $betaVersion . '.pkg', TODO: 3.13.0
				"signature" => "5wXe1phH6syvreaT+2Lah40CBzdyVnjzCWlmAjdwoKe/uSDlR+Hk5er+Y7nu/W2FDkeLvAxzNr2nK4HIhJZ+Cw==",
				// "fileProviderSignature" => "5wXe1phH6syvreaT+2Lah40CBzdyVnjzCWlmAjdwoKe/uSDlR+Hk5er+Y7nu/W2FDkeLvAxzNr2nK4HIhJZ+Cw==", TODO: 3.13.0
				"length" => 64530955 //,
				// "fileProviderLength" => 64530955  TODO: 3.13.0
			],
		],
		'daily' => [
			'linux' => [
				'version' => $dailyReleaseDateLinux,
				'versionstring' => "Nextcloud Daily " . $dailyReleaseDateLinux,
				'downloadurl' => $dailyUrl . 'linux/linux-' . $dailyReleaseDateLinux. '.AppImage',
				'web' => 'https://nextcloud.com/install',
			],
			'win32' => [
				'version' => $dailyReleaseDateWindows,
				'versionstring' => "Nextcloud Daily " . $dailyReleaseDateWindows,
				'downloadurl' => $dailyUrl . 'windows/windows-' . $dailyReleaseDateWindows . '.msi',
				'web' => 'https://nextcloud.com/install',
			],
			'macos' => [
				'version' => $dailyReleaseDateMacos,
				'versionstring' => "Nextcloud Daily " . $dailyReleaseDateMacos,
				'downloadurl' => $dailyUrl . 'macos/macos-' . $dailyReleaseDateMacos . '.pkg',
				'web' => 'https://nextcloud.com/install',
			],
		]
	]
];
