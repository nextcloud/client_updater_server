<?php
/**
 * SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types=1);

//
// daily
//
$dailyReleaseDateLinux = '20260228';
$dailyReleaseDateWindows = '20260301';
$dailyReleaseDateMacos = '20260301';

//
// beta
// should point to stable, once stable is released
//
$betaReleaseDate = '2026-02-27 14:00';
$betaVersionInternal = '32.0.82'; // short string
$betaVersion = '33.0.0-rc2'; // long string like '3.16.0-rc3' used to hide the cryptical subversion like .58 from the user;
$betaVersionSignature = '6PVC7PkBC2ad285V/raYyCY0E9NpZYF6C656uoFCcONKl4lcGcif1xVgE7FqbtuV1ycHF3weLA3pPnQlBpI5Cg==';
$betaVersionLength = 382961870;

//
// stable Qt6.9 (macOS 11 / 12 — not compatible with Qt6.10)
// fixed to the last Qt6.9-compatible stable release
//
$stableQt69ReleaseDate = '2026-01-22 18:00';
$stableQt69Version = '4.0.6';
$stableQt69VersionSignature = 'yzAm+RTOEtHCEmz1L4JHiRJkdfKMIeFAqYEJlaYNYP6s5IBKLq7YZY1sbtlmKQttRqKurB67s7dCuaGA2A6VBA==';
$stableQt69VersionLength = 345060719;
$stableQt69VersionFileProviderSignature = 'BCONOVs9x/wJxP4y5i0gqdwEErYFy9HFfGHYyWuXxUn6mgzhMlFLt3lFQOsuVvz2ADsR+fEdIqSFiSN8zEDYAA==';
$stableQt69VersionFileProviderLength = 373240934;

//
// stable
//
$stableReleaseDate = '2026-01-22 18:00';
$stableVersion = '4.0.6';
$stableVersionSignature = 'yzAm+RTOEtHCEmz1L4JHiRJkdfKMIeFAqYEJlaYNYP6s5IBKLq7YZY1sbtlmKQttRqKurB67s7dCuaGA2A6VBA==';
$stableVersionLength = 345060719;
$stableVersionFileProviderSignature = 'BCONOVs9x/wJxP4y5i0gqdwEErYFy9HFfGHYyWuXxUn6mgzhMlFLt3lFQOsuVvz2ADsR+fEdIqSFiSN8zEDYAA==';
$stableVersionFileProviderLength = 373240934;

//
// enterprise 
// should point to that stable version, that was branded to the customers
//
$enterpriseReleaseDate = '2026-01-28 11:30';
$enterpriseVersion = '4.0.6';
$enterpriseVersionSignature = 'yzAm+RTOEtHCEmz1L4JHiRJkdfKMIeFAqYEJlaYNYP6s5IBKLq7YZY1sbtlmKQttRqKurB67s7dCuaGA2A6VBA==';
$enterpriseVersionLength = 345060719;
$enterpriseVersionFileProviderSignature = 'BCONOVs9x/wJxP4y5i0gqdwEErYFy9HFfGHYyWuXxUn6mgzhMlFLt3lFQOsuVvz2ADsR+fEdIqSFiSN8zEDYAA==';
$enterpriseVersionFileProviderLength = 373240934;

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
 * do not change anything below here
 */
$dailyUrl = "https://download.nextcloud.com/desktop/daily/";

$betaVersionString = 'Nextcloud Client ' . $betaVersion;
$betaUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $betaVersion . '/';

$stableVersionString = 'Nextcloud Client ' . $stableVersion;
$stableUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $stableVersion . '/';

$stableQt69VersionString = 'Nextcloud Client ' . $stableQt69Version;
$stableQt69Url = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $stableQt69Version . '/';

$enterpriseVersionString = 'Nextcloud Client ' . $enterpriseVersion;
$enterpriseUrl = 'https://github.com/nextcloud-releases/desktop/releases/download/v' . $enterpriseVersion . '/';

// workaround for https://github.com/nextcloud/desktop/issues/9347
// Win32 4.0.4 and 4.0.5 do not follow HTTP redirects, which fails the download of updates
if ($platform == "win32" && (version_compare($version, '4.0.4', '>=') && version_compare($version, '4.0.6', '<'))) {
    $stableUrl = 'https://download.nextcloud.com/desktop/releases/Windows/';
    if (rand(0, 100) >= 10) {
        // only allow ~10% of requests receive an update to not overload the download server
        $stableVersion = '4.0.4';
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
                                'downloadurl' => $stableQt5_linux_url . 'Nextcloud-' . $stableQt5Version . '-x86_64.AppImage',
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
		'stable-qt6.9' => [
			'release' => $stableQt69ReleaseDate,
			'macos' => [
				'version' => $stableQt69Version,
				'versionstring' => $stableQt69VersionString,
				"fileProviderVersionString" => $stableQt69VersionString,
				'downloadurl' => $stableQt69Url . 'Nextcloud-' . $stableQt69Version . '.pkg',
				'fileProviderDownloadUrl' => $stableQt69Url . 'Nextcloud-' . $stableQt69Version . '-macOS-vfs.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $stableQt69Url . 'Nextcloud-' . $stableQt69Version . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $stableQt69Url . 'Nextcloud-' . $stableQt69Version . '-macOS-vfs.pkg.tbz',
				"signature" => $stableQt69VersionSignature,
				"length" => $stableQt69VersionLength,
				"fileProviderSignature" => $stableQt69VersionFileProviderSignature,
				"fileProviderLength" => $stableQt69VersionFileProviderLength,
			],
		],
		'stable' => [
			'release' => $stableReleaseDate,
			'linux' => [
				'version' => $stableVersion,
				'versionstring' => $stableVersionString,
				'downloadurl' => $stableUrl . 'Nextcloud-' . $stableVersion . '-x86_64.AppImage',
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
				"signature" => $stableVersionSignature,
				"length" => $stableVersionLength,
				"fileProviderSignature" => $stableVersionFileProviderSignature,
				"fileProviderLength" => $stableVersionFileProviderLength,
			],
		],
		'enterprise' => [
			'release' => $enterpriseReleaseDate,
			'linux' => [
				'version' => $enterpriseVersion,
				'versionstring' => $enterpriseVersionString,
				'downloadurl' => $enterpriseUrl . 'Nextcloud-' . $enterpriseVersion . '-x86_64.AppImage',
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
				"signature" => $enterpriseVersionSignature,
				"length" => $enterpriseVersionLength,
				"fileProviderSignature" => $enterpriseVersionFileProviderSignature,
				"fileProviderLength" => $enterpriseVersionFileProviderLength,
			],
		],
		'beta' => [
			'release' => $betaReleaseDate,
			'linux' => [
				'version' => $betaVersionInternal,
				'versionstring' => $betaVersionString,
				'downloadurl' => $betaUrl . 'Nextcloud-' . $betaVersion . '-x86_64.AppImage',
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
				"fileProviderVersionString" => $betaVersionString,
				'downloadurl' => $betaUrl . 'Nextcloud-' . $betaVersion . '.pkg',
				'fileProviderDownloadUrl' => $betaUrl . 'Nextcloud-' . $betaVersion . '.pkg',
				'web' => 'https://nextcloud.com/install',
				"sparkleDownloadUrl" => $betaUrl . 'Nextcloud-' . $betaVersion . '.pkg.tbz',
				"fileProviderSparkleDownloadUrl" => $betaUrl . 'Nextcloud-' . $betaVersion . '.pkg.tbz',
				"signature" => $betaVersionSignature,
				"length" => $betaVersionLength,
				"fileProviderSignature" => $betaVersionSignature,
				"fileProviderLength" => $betaVersionLength,
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
