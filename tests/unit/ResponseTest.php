<?php
/**
 * SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace Tests;

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase {

	public function updateDataProvider(): array
	{
		$config = [
			'nextcloud' => [
				'stable-qt5' => [
					'release' => '2019-01-01 01:01',
					'linux' => [
						'version' => '2.0.0',
						'versionstring' => 'Nextcloud Client 2.0.0',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0-x64.AppImage',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'win32' => [
						'version' => '2.0.0.0000',
						'versionstring' => 'Nextcloud Client 2.0.0 (build 0000)',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000-setup.exe',
					],
					'macos' => [
						'version' => '2.0.0.0000',
						'versionstring' => 'Nextcloud Client 2.0.0 (build 0000)',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000.pkg',
						'sparkleDownloadUrl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000.pkg.tbz',
						'signature' => 'MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=',
						'length' => 62738920,
					]
				],
				'stable' => [
					'release' => '2019-02-24 17:05',
					'linux' => [
						'version' => '2.2.2',
						'versionstring' => 'Nextcloud Client 2.2.2',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'win32' => [
						'version' => '2.2.2.6192',
						'versionstring' => 'Nextcloud Client 2.2.2 (build 6192)',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe',
					],
					'macos' => [
						'version' => '2.2.2.3472',
						'versionstring' => 'Nextcloud Client 2.2.2 (build 3472)',
						'downloadurl' => 'https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg',
						'sparkleDownloadUrl' => 'https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz',
						'signature' => 'MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=',
						'length' => 62738920,
					]
				],
				'enterprise' => [
					'release' => '2019-02-24 17:05',
					'linux' => [
						'version' => '2.2.2',
						'versionstring' => 'Nextcloud Client 2.2.2',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'win32' => [
						'version' => '2.2.2.6192',
						'versionstring' => 'Nextcloud Client 2.2.2 (build 6192)',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe',
					],
					'macos' => [
						'version' => '2.2.2.3472',
						'versionstring' => 'Nextcloud Client 2.2.2 (build 3472)',
						'downloadurl' => 'https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg',
						'sparkleDownloadUrl' => 'https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz',
						'signature' => 'MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=',
						'length' => 62738920,
					]
				],
				'beta' => [
					'release' => '2020-01-01 01:01',
					'linux' => [
						'version' => '2.2.2-rc2',
						'versionstring' => 'Nextcloud Client 2.2.2-rc2',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc2-x64.AppImage',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'win32' => [
						'version' => '2.2.3-rc3',
						'versionstring' => 'Nextcloud Client 2.2.3-rc3',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.3-rc3-x86.msi',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'macos' => [
						'version' => '2.2.2-rc2',
						'versionstring' => 'Nextcloud Client 2.2.2-rc2',
						'downloadurl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc2.pkg',
						'sparkleDownloadUrl' => 'https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc1.pkg.tbz',
						'signature' => 'MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=',
						'length' => 62738920,
					]
				],
				'daily' => [
					'linux' => [
						'version' => '20240604',
						'versionstring' => 'Nextcloud Daily 20240604',
						'downloadurl' => 'https://download.nextcloud.com/desktop/daily/linux/linux-20240604.AppImage',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'win32' => [
						'version' => '20240604',
						'versionstring' => 'Nextcloud Daily 20240604',
						'downloadurl' => 'https://download.nextcloud.com/desktop/daily/windows/windows-20240604.msi',
						'web' => 'https://nextcloud.com/install/#install-clients',
					],
					'macos' => [
						'version' => '20240604',
						'versionstring' => 'Nextcloud Daily 20240604',
						'downloadurl' => 'https://download.nextcloud.com/desktop/daily/macos/macos-20240604.pkg',
						'web' => 'https://nextcloud.com/install/#install-clients',
					]
				],
			]
		];

		$configThrottle = $config;
		$configThrottle['nextcloud']['stable']['release'] = (new \DateTime())->sub(new \DateInterval('PT6H'))->format('Y-m-d H:m');

		return [
			// #0 Update segment is already allowed
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.26080",
				'stable',
				false,
                false,
				$configThrottle,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #1 Updates for client available
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.26080",
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #2
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.26080",
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #3
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'',
				'rhel',
				'9.3',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #4
			[
			'nextcloud',
				'macos',
				'1.9.0',
				'',
				'12.4',
				'21.04.00',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.3472</version><versionstring>Nextcloud Client 2.2.2 (build 3472)</versionstring><downloadurl>https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg</downloadurl><sparkleDownloadUrl>https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz</sparkleDownloadUrl><signature>MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=</signature><length>62738920</length></owncloudclient>
'
			],
			// #5
			[
				'nextcloud',
				'macos',
				'1.9.0',
				'',
				"12",
				"21.0.1",
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.2.2 (build 3472)</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
			],
			// #6 stable -> beta version
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.26080",
				'beta',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.3-rc3</version><versionstring>Nextcloud Client 2.2.3-rc3</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.3-rc3-x86.msi</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #7 older beta -> newer beta version
			[
				'nextcloud',
				'win32',
				'2.2.3-rc1',
				'',
				"11",
				"10.0.26080",
				'beta',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.3-rc3</version><versionstring>Nextcloud Client 2.2.3-rc3</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.3-rc3-x86.msi</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #8 older beta, but newer stable -> update
			[
				'nextcloud',
				'linux',
				'2.2.2-rc1',
				'',
				'rhel',
				'9.3',
				'beta',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #9 Updates for not existing entries
			[
				'randomOem',
				'macos',
				'1.9.0',
				'',
				"12",
				"21.0.1",
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #10
			[
				'nextcloud',
				'randomOs',
				'1.9.0',
				'',
				'unknown',
				'???',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #11 No updates if the version is the same
			[
				'nextcloud',
				'win32',
				'2.2.2.6192',
				'',
				"11",
				"10.0.26080",
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #12
			[
				'nextcloud',
				'win32',
				'2.2.6192',
				'',
				"11",
				"10.0.26080",
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #13
			[
				'nextcloud',
				'linux',
				'2.2.2',
				'',
				'rhel',
				'9.3',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #14
			[
				'nextcloud',
				'macos',
				'2.2.2.3472',
				'',
				'12.4',
				'21.04.00',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #15 Except for Sparkle, which always needs to know what the latest version is
			[
				'nextcloud',
				'macos',
				'2.2.2.3472',
				'',
				'12.4',
				'21.04.00',
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.2.2 (build 3472)</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
			],
			// #16 No updates if the version is higher
			[
				'nextcloud',
				'win32',
				'2.3',
				'',
				"11",
				"10.0.26080",
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #17
			[
				'nextcloud',
				'win32',
				'2.3',
				'',
				"11",
				"10.0.26080",
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #18
			[
				'nextcloud',
				'linux',
				'2.3',
				'',
				'rhel',
				'9.3',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #19
			[
				'nextcloud',
				'macos',
				'2.3',
				'',
				'12.4',
				'21.04.00',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #20 Again, Sparkle needs to know about the latest version
			[
				'nextcloud',
				'macos',
				'2.3',
				'',
				'11.0',
				'21.04.00',
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.2.2 (build 3472)</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
			],
            // #21 Sparkle on, always needs to know what the latest version is
            [
                'nextcloud',
                'macos',
                '2.2.2-rc2',
				'',
				'12.4',
				'21.04.00',
                'beta',
                true,
                false,
                $config,
                '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.2.2-rc2</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc1.pkg.tbz" sparkle:version="2.2.2-rc2" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
		    ],
            // #22 Sparkle on, always needs to know what the latest version is
            [
                'nextcloud',
                'macos',
                '2.2.2',
				'',
				'12.4',
				'21.04.00',
                'beta',
                true,
                false,
                $config,
                '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.2.2-rc2</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc1.pkg.tbz" sparkle:version="2.2.2-rc2" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
            ],
			// #23 daily
			[
				'nextcloud',
				'linux',
				'20240601',
				'',
				'debian',
				'20',
				'daily',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>20240604</version><versionstring>Nextcloud Daily 20240604</versionstring><downloadurl>https://download.nextcloud.com/desktop/daily/linux/linux-20240604.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #24 Win7 -> QT5
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"7",
				"06.01.00",
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0.0000</version><versionstring>Nextcloud Client 2.0.0 (build 0000)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000-setup.exe</downloadurl></owncloudclient>
'
			],
			// #25 Win10 -> QT5
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"10",
				"10.0.1800",
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0.0000</version><versionstring>Nextcloud Client 2.0.0 (build 0000)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000-setup.exe</downloadurl></owncloudclient>
'
			],
			// #26 Win10 -> QT6
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"10",
				"10.0.26080",
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #27 Win11 -> QT6
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.22622",
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #28 stable-qt5 -> old beta -> latest qt5 stable
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"10",
				'10.0.1500',
				'beta',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0.0000</version><versionstring>Nextcloud Client 2.0.0 (build 0000)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000-setup.exe</downloadurl></owncloudclient>
'
			],
			// #29 MAC QT5
			[
				'nextcloud',
				'macos',
				'1.9.0',
				'',
				"10.16",
				"21.0.1.00",
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.0.0 (build 0000)</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000.pkg.tbz" sparkle:version="2.0.0.0000" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
			],
			// #30 old Win11 -> QT5
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.17700",
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0.0000</version><versionstring>Nextcloud Client 2.0.0 (build 0000)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0.0000-setup.exe</downloadurl></owncloudclient>
'
			],
			// #31 old Ubuntu
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'ubuntu',
				'22.00',
				'5.5.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0</version><versionstring>Nextcloud Client 2.0.0</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #32 new Ubuntu
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'ubuntu',
				'24.04',
				'6.6.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #33 old RHEL
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'rhel',
				'8.0',
				'5.5.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0</version><versionstring>Nextcloud Client 2.0.0</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #34 new RHEL
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'rhel',
				'9.4',
				'6.6.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #35 old openSuse
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'opensuse-leap',
				'15.1',
				'5.5.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.0.0</version><versionstring>Nextcloud Client 2.0.0</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.0.0-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #36 new openSuse
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'opensuse-leap',
				'15.6',
				'6.6.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #37 new openSuse
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'opensuse-leap',
				'15.6',
				'6.6.0',
				'enterprise',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #38 Win11 -> QT6
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'',
				"11",
				"10.0.22622",
				'enterprise',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],		
			// #39 Again, Sparkle needs to know about the latest version
			[
				'nextcloud',
				'macos',
				'2.3',
				'',
				'11.0',
				'21.04.00',
				'enterprise',
				true,
                false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>
		<item>
			<title>Nextcloud Client 2.2.2 (build 3472)</title>
			<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
			<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>
	</channel>
</rss>'
			],				
        ];
	}

	/**
	 * @dataProvider updateDataProvider
	 *
	 * @param string $oem
	 * @param string $platform
	 * @param string $version
	 * @param string $osVersion
	 * @param string $kernelVersion
	 * @param string $channel
	 * @param bool $isSparkle
	 * @param bool $isFileProvider
	 * @param array $config
	 * @param string $expected
	 */
	public function testBuildResponse(string $oem,
									  string $platform,
									  string $version,
									  string $osRelease,
									  string $osVersion,
									  string $kernelVersion,
									  string $channel,
									  bool $isSparkle,
                                      bool $isFileProvider,
									  array $config,
									  string $expected) {
		$response = $this->getMockBuilder('\ClientUpdateServer\Response')
			->setConstructorArgs([
				$oem,
				$platform,
				$version,
				$osRelease,
				$osVersion,
				$kernelVersion,
				$channel,
				$isSparkle,
				$isFileProvider,
				$config])
			->setMethods(['getCurrentTimeStamp'])
			->getMock();
		$response
			->expects($this->any())
			->method('getCurrentTimeStamp')
			->willReturn('Wed, 13 July 16 21:07:31 +0200');

		$this->assertSame($expected, $response->buildResponse());
	}
}
