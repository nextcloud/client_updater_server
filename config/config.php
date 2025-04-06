<?php
/**
 * SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types=1);

//
// daily
//
$dailyReleaseDateLinux = '20250406';
$dailyReleaseDateWindows = '20250406';
$dailyReleaseDateMacos = '20250404';
$dailyUrl = "https://download.nextcloud.com/desktop/daily/";

//
// beta
//
$betaReleaseDate = '2025-02-26 10:00';
$betaVersionInternal = '3.15.83';
$betaVersion = '3.16.0-rc3';
$betaVersionString = 'Nextcloud Client ' . $betaVersion;
$betaUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $betaVersion . '/';

//
// stable
//
$stableReleaseDate = '2025-03-19 19:00';
$stableVersion = '3.16.2';
$stableVersionString = 'Nextcloud Client ' . $stableVersion;
$stableUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $stableVersion . '/';

//
// enterprise
//
$enterpriseReleaseDate = '2025-01-07 15:00';
$enterpriseVersion = '3.15.2';
$enterpriseVersionString = 'Nextcloud Client ' . $enterpriseVersion;
$enterpriseUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $enterpriseVersion . '/';

//
// stable Qt5 (legacy)
//
$stableQt5_url = 'https://download.nextcloud.com/desktop/releases/';
$stableQt5_linux_url = $stableQt5_url . 'Linux/';
$stableQt5_windows_url = $stableQt5_url . 'Windows/';
$stableQt5_mac_url = $stableQt5_url . 'Mac/Installer/';
$stableQt5ReleaseDate = '2024-09-13 12:00';
$stableQt5Version = '3.13.4';
$stableQt5fileProviderVersion = '3.13.4';
$stableQt5VersionString = 'Nextcloud Client ' . $stableQt5Version;
$stableQt5fileProviderVersionString = 'Nextcloud Client ' . $stableQt5fileProviderVersion;

//
// Windows installer
//
$windows_suffix = '-x64.msi';
if (version_compare($version, '3.1.0') < 0) {
    $windows_suffix = '-setup.exe';
    $stableVersion = '3.1.3';
} else {
    if ($buildArch === 'i386') {
        $windows_suffix = '-x86.msi';
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
                                "fileProviderVersionString" => $stableQt5fileProviderVersionString,
                                'downloadurl' => $stableQt5_mac_url . 'Nextcloud-' . $stableQt5Version . '.pkg',
                                'fileProviderDownloadUrl' => $stableQt5_mac_url . 'Nextcloud-' . $stableQt5fileProviderVersion . '-macOS-vfs.pkg',
                                'web' => 'https://nextcloud.com/install',
                                "sparkleDownloadUrl" => $stableQt5_mac_url . 'Nextcloud-' . $stableQt5Version . '.pkg.tbz',
                                "fileProviderSparkleDownloadUrl" => $stableQt5_mac_url . 'Nextcloud-' . $stableQt5fileProviderVersion . '-macOS-vfs.pkg.tbz',
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
				'downloadurl' => $stableUrl . 'Nextcloud-' . $stableVersion . '-x64.AppImage',
				'web' => 'https://nextcloud.com/install',
			],
			'win32' => [
				'version' => $stableVersion,
				'versionstring' => $stableVersionString,
				'downloadurl' => $stableUrl . 'Nextcloud-' . $stableVersion . $windows_suffix,
				'web' => 'https://nextcloud.com/install',
			],
			'macos' => [
				'version' => $stableVersion,
				'versionstring' => $stableVersionString,
				"fileProviderVersionString" => $stableVersionString,
				'downloadurl' => $stableUrl . 'Nextcloud-' . $stableVersion . '.pkg',
				'fileProviderDownloadUrl' => $stableUrl . 'Nextcloud-' . $stableVersion . '-macOS-vfs.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $stableUrl . 'Nextcloud-' . $stableVersion . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $stableUrl . 'Nextcloud-' . $stableVersion . '-macOS-vfs.pkg.tbz',
				"signature" => "M/cd4ZqZsI5fxa42UjVd1YcWZciQ+SshLxr+uqYhRjnNGzGyPziGLTdEJIorCsthAQq5hK741Zs9Gi2XkItnAA==",
				"length" => 332225941,
				"fileProviderSignature" => "YLN1NI1CjYJfuXeWYU5YGCaNEDbMVTBUON0bJl/NPjdK+fjZif/XXRa9RrjNEY/FAZMrUx1+ocFoOsGR1lSFCg==",
				"fileProviderLength" => 374017592,
			],
		],
		'enterprise' => [
			'release' => $enterpriseReleaseDate,
			'linux' => [
				'version' => $enterpriseVersion,
				'versionstring' => $enterpriseVersionString,
				'downloadurl' => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . '-x64.AppImage',
				'web' => 'https://nextcloud.com/install',
			],
			'win32' => [
				'version' => $enterpriseVersion,
				'versionstring' => $enterpriseVersionString,
				'downloadurl' => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . $windows_suffix,
				'web' => 'https://nextcloud.com/install',
			],
			'macos' => [
				'version' => $enterpriseVersion,
				'versionstring' => $enterpriseVersionString,
				"fileProviderVersionString" => $enterpriseVersionString,
				'downloadurl' => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . '.pkg',
				'fileProviderDownloadUrl' => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . '-macOS-vfs.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . '-macOS-vfs.pkg.tbz',
				"signature" => "wKIuw5109sTIvGvSuBTXlGp93TizSjFka45OslbgTIFrK+XzLJc2Zs+xCcpPcHLXBeFeKByq+ST1XpinWKSdBA==",
				"length" => 321172605,
				"fileProviderSignature" => "fQUSg4tLPip6etSv2ESVj9ALrcfVTMQNbuPPZD8alKLasAsEkGRAVZinNaRITDfNJo0cmkyEdePniZ4EAvDPAg==",
				"fileProviderLength" => 369917941,
			],
		],
		'beta' => [
			'release' => $betaReleaseDate,
			'linux' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $betaUrl . 'Nextcloud-' . $betaVersion . '-x64.AppImage',
				'web' => 'https://nextcloud.com/install',
			],
			'win32' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $betaUrl . 'Nextcloud-' . $betaVersion . $windows_suffix,
				'web' => 'https://nextcloud.com/install',
			],
			'macos' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $betaUrl . 'Nextcloud-' . $betaVersion . '.pkg',
				'fileProviderDownloadUrl' => $betaUrl . 'Nextcloud-' . $betaVersion . '-macOS-vfs.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $betaUrl . 'Nextcloud-' . $betaVersion . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $betaUrl . 'Nextcloud-' . $betaVersion . '-macOS-vfs.pkg.tbz',
				"signature" => "eGaQ6la/p0Bhxzh/ap636goUtF1lZLXmSueVYmalUDmQrVma7O+EXd5OUfFqCBYV1WWuOT7iskhavVB6grMkDg==",
				"fileProviderSignature" => "6RXIWEoWf2fNNkm6yyzSG7qFTL6dTSFCvkTe+3iJyXP6xXeZrybxOhnKSK5hGXXvkk/66obRL/vWF2a2k641Bw==",
				"length" => 332399269,
				"fileProviderLength" => 382475147,
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
