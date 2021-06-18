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

	public function updateDataProvider(): array {
		$config = [
			'nextcloud' => [
				'release' => '2019-02-24 17:05',
				'linux' => [
					'version' => '2.2.2',
					'versionstring' => 'Nextcloud Client 2.2.2',
					'web' => 'https://nextcloud.com/install/#install-clients',
				],
				'win32' => [
					'version' => '2.2.2.6192',
					'versionstring' => 'Nextcloud Client 2.2.2 (build 6192)',
					'downloadUrl' => 'https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe',
				],
				'macos' => [
					'version' => '2.2.2.3472',
					'versionstring' => 'Nextcloud Client 2.2.2 (build 3472)',
					'downloadUrl' => 'https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz',
					'signature' => 'MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=',
				],
			]
		];

		$configThrottle = $config;
		$configThrottle['nextcloud']['release'] = (new \DateTime())->sub(new \DateInterval('PT6H'))->format('Y-m-d H:m');

		return [
			// Update segment is already allowed
			[
				'nextcloud',
				'win32',
				'1.9.0',
				false,
				5,
				$configThrottle,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadUrl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadUrl></owncloudclient>
'
			],
			// Update segment is not yet allowed
			[
				'nextcloud',
				'win32',
				'1.9.0',
				false,
				95,
				$configThrottle,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],

			// Updates for client available
			[
				'nextcloud',
				'win32',
				'1.9.0',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadUrl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadUrl></owncloudclient>
'
			],
			[
				'nextcloud',
				'win32',
				'1.9.0',
				true,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.6192</version><versionstring>Nextcloud Client 2.2.2 (build 6192)</versionstring><downloadUrl>https://download.nextcloud.com/desktop/stable/ownCloud-2.2.2.6192-setup.exe</downloadUrl></owncloudclient>
'
			],
			[
				'nextcloud',
				'linux',
				'1.9.0',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2</version><versionstring>Nextcloud Client 2.2.2</versionstring><web>https://nextcloud.com/install/#install-clients</web></owncloudclient>
'
			],
			[
			'nextcloud',
				'macos',
				'1.9.0',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient><version>2.2.2.3472</version><versionstring>Nextcloud Client 2.2.2 (build 3472)</versionstring><downloadUrl>https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz</downloadUrl><signature>MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY=</signature></owncloudclient>
'
			],
			[
				'nextcloud',
				'macos',
				'1.9.0',
				true,
				-1,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language><item>
					<title>Nextcloud Client 2.2.2 (build 3472)</title>
					<pubDate>Wed, 13 July 16 21:07:31 +0200</pubDate>
					<enclosure url="https://download.owncloud.com/desktop/stable/ownCloud-2.2.2.3472.pkg.tbz" sparkle:version="2.2.2.3472" type="application/octet-stream" sparkle:dsaSignature="MC0CFQDmXR6biDmNVW7TvMh0bfPPTzCvtwIUCzASgpzYdi4lltOnwbFCeQwgDjY="/>
					<sparkle:minimumSystemVersion>10.7.0</sparkle:minimumSystemVersion>
				</item></channel>
			</rss>'
			],
			// Updates for not existing entries
			[
				'randomOem',
				'macos',
				'1.9.0',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'ramdomOs',
				'1.9.0',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			// No updates if the version is the same
			[
				'nextcloud',
				'win32',
				'2.2.2.6192',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'win32',
				'2.2.6192',
				true,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'linux',
				'2.2.2',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'macos',
				'2.2.2.3472',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'macos',
				'2.2.2.3472',
				true,
				-1,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language></channel>
			</rss>'
			],
			// No updates if the version is higher
			[
				'nextcloud',
				'win32',
				'2.3',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'win32',
				'2.3',
				true,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'linux',
				'2.3',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'macos',
				'2.3',
				false,
				-1,
				$config,
				'<?xml version="1.0"?>
<owncloudclient/>
'
			],
			[
				'nextcloud',
				'macos',
				'2.3',
				true,
				-1,
				$config,
				'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language></channel>
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
	 * @param bool $isSparkle
	 * @param int $updateSegment
	 * @param array $config
	 * @param string $expected
	 */
	public function testBuildResponse(string $oem,
									  string $platform,
									  string $version,
									  bool $isSparkle,
									  int $updateSegment,
									  array $config,
									  string $expected) {
		$response = $this->getMockBuilder('\ClientUpdateServer\Response')
			->setConstructorArgs([$oem, $platform, $version, $isSparkle, $updateSegment, $config])
			->setMethods(['getCurrentTimeStamp'])
			->getMock();
		$response
			->expects($this->any())
			->method('getCurrentTimeStamp')
			->willReturn('Wed, 13 July 16 21:07:31 +0200');

		$this->assertSame($expected, $response->buildResponse());
	}
}
