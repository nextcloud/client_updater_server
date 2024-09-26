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

$stableReleaseDate = '2024-09-15 10:00';
$stableVersion = '3.14.0';
$fileProviderStableReleaseDate = '2024-09-15 10:00';
$fileProviderStableVersion = '3.14.0';

$betaReleaseDate = '2024-09-09 17:00';
$betaVersionInternal = '3.13.83';
$betaVersion = '3.14.0-rc3';

$dailyReleaseDateLinux = '20240926';
$dailyReleaseDateWindows = '20240926';
$dailyReleaseDateMacos = '20240924';
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

$stableQt5ReleaseDate = '2024-09-13 12:00';
$stableQt5Version = '3.13.4';
$fileProviderStableQt5Version = '3.13.4';
$stableQt5VersionString = 'Nextcloud Client ' . $stableQt5Version;
$fileProviderStableQt5VersionString = 'Nextcloud Client ' . $fileProviderStableQt5Version;
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
                                "signature" => "8cG1fsKD6OaFpe8npjDNAfI0EGWK69UHsusTKIAv0pGcd0MALM9Hqc+cWKGxH338LNPe4It65/KRI5cykoScDw==",
                                "length" => 64634085,
                                "fileProviderSignature" => "ZI/hNmZ3zedPHEwWuzAvqSSf5ddPkW+XrzYjRguRIcX0zDxXh1OR9iEr5BDIS8X9LeLoaRbaGLGHXlm7xQCxAA==",
                                "fileProviderLength" => 97371547,
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
				"signature" => "Fu2tbLugDkKyVWp7IJdr4IYK4LCyJcXdZkexo44B4qB56hKyzAU3Jvjz3Tz5QPE1ADHDUwpZYJTxn0dqdhnpBA==",
				"length" => 317882368,
				"fileProviderSignature" => "Ck2HA+vpKwM3dAGNKswDfln4XJJUOwbUpFkxHNYXHSFJkqc/2AKX9UUUvGZ0+1az416Q6pZ1MD39m7uPuTWyBw==",
				"fileProviderLength" => 368671978,
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
				"signature" => "DZQGmsUNZBwsbks+q59/qoRyEtLIfq41TUce5olxiLzXVUMi+BmJMQB9K50fRhYbp3TE+ranCOa5xh1gnLPhAw==",
				"fileProviderSignature" => "ruLAEp2bOmfe9s/4WjaOr3m1JMP7dtGcoZaoFN5tgtbdFT7XVAvNT166ZDMgDUiWy3bRwrg3I6gMlpKRHpMqAw==",
				"length" => 317860352,
				"fileProviderLength" => 366970368,
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
