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

namespace Tests;

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase {

	public function updateDataProvider(): array
	{
		$config = [
			'nextcloud' => [
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
						'length' => '62738920',
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
						'length' => '62738920',
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
				'stable',
				false,
                false,
				$configThrottle,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #2 Updates for client available
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'stable',
				false,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #3
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'stable',
				true,
                false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadurl></owncloudclient>
'
			],
			// #4
			[
				'nextcloud',
				'linux',
				'1.9.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #5
			[
			'nextcloud',
				'macos',
				'1.9.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.3472</version><versionstring>Nextcloud Client 2.2.2 (build 3472)</versionstring><downloadurl>https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg</downloadurl><sparkleDownloadUrl>https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz</sparkleDownloadUrl><signature>MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=</signature><length>62738920</length></owncloudclient>
'
			],
			// #6
			[
				'nextcloud',
				'macos',
				'1.9.0',
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language><item>
					<title>Nextcloud Client 2.2.2 (build 3472)</title>
					<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
					<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
					<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
				</item></channel>
			</rss>'
			],
			// #7 stable -> beta version
			[
				'nextcloud',
				'win32',
				'1.9.0',
				'beta',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.3-rc3</version><versionstring>Nextcloud Client 2.2.3-rc3</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.3-rc3-x86.msi</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #8 older beta -> newer beta version
			[
				'nextcloud',
				'win32',
				'2.2.3-rc1',
				'beta',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.3-rc3</version><versionstring>Nextcloud Client 2.2.3-rc3</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.3-rc3-x86.msi</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #9 older beta, but newer stable -> update
			[
				'nextcloud',
				'linux',
				'2.2.2-rc1',
				'beta',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><downloadurl>https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-x64.AppImage</downloadurl><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			// #10 Updates for not existing entries
			[
				'randomOem',
				'macos',
				'1.9.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #11
			[
				'nextcloud',
				'randomOs',
				'1.9.0',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #12 No updates if the version is the same
			[
				'nextcloud',
				'win32',
				'2.2.2.6192',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #13
			[
				'nextcloud',
				'win32',
				'2.2.6192',
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #14
			[
				'nextcloud',
				'linux',
				'2.2.2',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #15
			[
				'nextcloud',
				'macos',
				'2.2.2.3472',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #16 Except for Sparkle, which always needs to know what the latest version is
			[
				'nextcloud',
				'macos',
				'2.2.2.3472',
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language><item>
					<title>Nextcloud Client 2.2.2 (build 3472)</title>
					<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
					<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
					<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
				</item></channel>
			</rss>'
			],
			// #17 No updates if the version is higher
			[
				'nextcloud',
				'win32',
				'2.3',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #18
			[
				'nextcloud',
				'win32',
				'2.3',
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #19
			[
				'nextcloud',
				'linux',
				'2.3',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #20
			[
				'nextcloud',
				'macos',
				'2.3',
				'stable',
				false,
				false,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// #21 Again, Sparkle needs to know about the latest version
			[
				'nextcloud',
				'macos',
				'2.3',
				'stable',
				true,
				false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language><item>
					<title>Nextcloud Client 2.2.2 (build 3472)</title>
					<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
					<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
					<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
				</item></channel>
			</rss>'
			],
            // #22 Sparkle on, always needs to know what the latest version is
            [
				'nextcloud',
				'macos',
				'2.2.2-rc2',
				'beta',
				true,
				false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language><item>
					<title>Nextcloud Client 2.2.2-rc2</title>
					<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
					<enclosure url="https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc1.pkg.tbz" sparkle:version="2.2.2-rc2" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
					<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
				</item></channel>
			</rss>'
		    ],
			// #23 Sparkle on, always needs to know what the latest version is
			[
				'nextcloud',
				'macos',
				'2.2.2',
				'beta',
				true,
				false,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language><item>
					<title>Nextcloud Client 2.2.2-rc2</title>
					<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
					<enclosure url="https://download.nextcloud.com/desktop/stable/Nextcloud-2.2.2-rc1.pkg.tbz" sparkle:version="2.2.2-rc2" type="application/octet-stream" sparkle:edSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=" length="62738920"/>
					<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
				</item></channel>
			</rss>'
			]
		];
	}

	/**
	 * @dataProvider updateDataProvider
	 *
	 * @param string $oem
	 * @param string $platform
	 * @param string $version
	 * @param string $channel
	 * @param bool $isSparkle
     * @param bool $isFileProvider
	 * @param array $config
	 * @param string $expected
	 */
	public function testBuildResponse(string $oem,
									  string $platform,
									  string $version,
									  string $channel,
									  bool $isSparkle,
                                      bool $isFileProvider,
									  array $config,
									  string $expected) {
		$response = $this->getMockBuilder('\ClientUpdateServer\Response')
			->setConstructorArgs([$oem, $platform, $version, $channel, $isSparkle, $isFileProvider, $config])
			->setMethods(['getCurrentTimeStamp'])
			->getMock();
		$response
			->expects($this->any())
			->method('getCurrentTimeStamp')
			->willReturn('Wed, 13 July 16 21:07:31 +0200');

		$this->assertSame($expected, $response->buildResponse());
	}
}
