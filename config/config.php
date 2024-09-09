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

$stableReleaseDate = '2024-08-23 16:00';
$stableVersion = '3.13.3';
$fileProviderStableReleaseDate = '2024-08-23 16:00';
$fileProviderStableVersion = '3.13.3';

$betaReleaseDate = '2024-08-26 19:00';
$betaVersionInternal = '3.13.81';
$betaVersion = '3.14.0-rc1';

$dailyReleaseDateLinux = '20240909';
$dailyReleaseDateWindows = '20240909';
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

	$betaUrl = 'https://download.nextcloud.com/desktop/prereleases/';
	$stable_linux_url = $url . 'Linux/';
	$stable_windows_url = $url . 'Windows/';
	$stable_mac_url = $url . 'Mac/';
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

$stableQt5ReleaseDate = $stableReleaseDate;
$stableQt5Version = $stableVersion;
$fileProviderStableQt5Version = $fileProviderStableVersion;
$stableQt5VersionString = $stableVersionString;
$fileProviderStableQt5VersionString = $fileProviderStableVersionString;
$stableQt5_linux_url = $stable_linux_url;
$stableQt5_windows_url = $stable_windows_url;
$stableQt5_mac_url = $stable_mac_url;

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
		'stable-qt5' => [
			'release' => $stableQt5ReleaseDate,
                        'linux' => [
                                'version' => $stableQt5Version,
                                'versionstring' => $stableQt5VersionString,
                                'downloadurl' => $stableQt5_linux_url . 'Nextcloud-' . $stableQt5Version . '-x64.AppImage',
                                'web' => 'https://nextcloud.com/install',
                        ],
                        'win32' => [
                                'version' => $stableQt5Version,
                                'versionstring' => $stableQt5VersionString,
                                'downloadurl' => $stableQt5_windows_url . 'Nextcloud-' . $stableQt5Version . $windows_suffix,
                                'web' => 'https://nextcloud.com/install',
                        ],
                        'macos' => [
                                'version' => $stableQt5Version,
                                'versionstring' => $stableQt5VersionString,
                                "fileProviderVersionString" => $fileProviderStableQt5VersionString,
                                'downloadurl' => $stableQt5_mac_url . 'Nextcloud-' . $stableQt5Version . '.pkg',
                                'fileProviderDownloadUrl' => $stableQt5_mac_url . 'Nextcloud-' . $fileProviderStableQt5Version . '-macOS-vfs.pkg',
                                'web' => 'https://nextcloud.com/install',
                                "sparkleDownloadUrl" => $stableQt5_mac_url . 'Nextcloud-' . $stableQt5Version . '.pkg.tbz',
                                "fileProviderSparkleDownloadUrl" => $stableQt5_mac_url . 'Nextcloud-' . $fileProviderStableQt5Version . '-macOS-vfs.pkg.tbz',
                                "signature" => "r3N8KG8vYVlu+ONRXtlrPtWW1ueTF1eUr9Zkq1b/aBpdBfPV0y/7MWSTtdonJ6l3IYwVVQsGW6pxZ7nfILrqCw==",
                                "length" => 64628815,
                                "fileProviderSignature" => "Y5H86yeRuwFtNFJOqcGe1xzbFNEmxQgjft5oOoezQ31fo8PHgZ7BkHrunY1s4yYKNYkTUqpgvtYws2W9WBujCw==",
                                "fileProviderLength" => 97379078,
                        ],
		],		
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
				"signature" => "r3N8KG8vYVlu+ONRXtlrPtWW1ueTF1eUr9Zkq1b/aBpdBfPV0y/7MWSTtdonJ6l3IYwVVQsGW6pxZ7nfILrqCw==",
				"length" => 64628815,
				"fileProviderSignature" => "Y5H86yeRuwFtNFJOqcGe1xzbFNEmxQgjft5oOoezQ31fo8PHgZ7BkHrunY1s4yYKNYkTUqpgvtYws2W9WBujCw==",
				"fileProviderLength" => 97379078,
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
				'fileProviderDownloadUrl' => $beta_mac_url . 'Nextcloud-macOS-vfs-' . $betaVersion . '.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $beta_mac_url . 'Nextcloud-' . $betaVersion . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $beta_mac_url . 'Nextcloud-macOS-vfs-' . $betaVersion . '.pkg',
				"signature" => "dPAZfEPQcGmD4WMrTAkBvSReKaCjwIfRtB0m3RuScXs3be715Uj9Tnb0ACECRX+s2ezwFr8m87VFxobJyIcaDw==",
				"fileProviderSignature" => "nKZ67tDDIyg91J3TLli336mboEDvV1yOz9NELxLXThENbb0Py1Z7vw8Xa5OHCK/jp4s0SRRotY0jXKwSls8KDA==",
				"length" => 140539623,
				"fileProviderLength" => 189038736,
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
