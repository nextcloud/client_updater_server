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
namespace ClientUpdateServer;

class Response {
	/** @var string */
	private $oem;
	/** @var string */
	private $platform;
	/** @var string */
	private $version;
	/** @var bool */
	private $isSparkle;
	/** @var array */
	private $config;

	/**
	 * @param string $oem
	 * @param string $platform
	 * @param string $version
	 * @param bool $isSparkle
	 * @param int $updatesegment
	 * @param array $config
	 */
	public function __construct(string $oem,
								string $platform,
								string $version,
								bool $isSparkle,
								int $updateSegment,
								array $config) {
		$this->oem = $oem;
		$this->platform = $platform;
		$this->version = $version;
		$this->isSparkle = $isSparkle;
		$this->updateSegment = $updateSegment;
		$this->config = $config;
	}

	/**
	 * Gets the version to update to. Or an empty array if no update is available.
	 *
	 * @return array
	 */
	private function getUpdateVersion() : array {
		if(!isset($this->config[$this->oem])) {
			if (preg_match('/^[a-zA-Z0-9-_.]+$/', $this->oem) !== 1) {
				return [];
			}

			if (!file_exists(__DIR__ . '/../config/' . $this->oem . '.json')) {
				return [];
			}

			$content = file_get_contents(__DIR__ . '/../config/' . $this->oem . '.json');
			if ($content === false) {
				return [];
			}
			$data = json_decode($content, true);

			if (!is_array($data)) {
				return [];
			}

			$this->config[$this->oem] = $data;
		}

		if(!isset($this->config[$this->oem][$this->platform])) {
			return [];
		}

		$releaseDate = new \DateTime($this->config[$this->oem]['release']);
		$throttleDate = new \DateTime();

		if ($this->updateSegment === -1) {
			$this->updateSegment = random_int(0, 99);
		}

		// updateSegment is 0-99, so even fine grained control would possible
		$chunks = floor($this->updateSegment / 10);
		$throttleDate->sub(new \DateInterval('PT' . (12 * $chunks) . 'H'));

		if ($throttleDate <= $releaseDate) {
			$values = $this->config[$this->oem][$this->platform];
			if(version_compare($this->version, $values['version']) === -1) {
				return $values;
			}
		}

		return [];
	}

	/**
	 * Returns the current time stamp
	 * @return string
	 */
	protected function getCurrentTimeStamp() : string {
		return (new \DateTime())->format('D, j F y H:m:s O');
	}

	/**
	 * Builds the response for Sparkle (used by the Mac updater)
	 *
	 * @param array $updateVersion
	 * @return string
	 */
	private function buildSparkleResponse(array $updateVersion) : string {
		$item = !empty($updateVersion) ? '<item>
					<title>'.$updateVersion['versionstring'].'</title>
					<pubDate>'.$this->getCurrentTimeStamp().'</pubDate>
					<enclosure url="'.$updateVersion['downloadUrl'].'" sparkle:version="'.$updateVersion['version'].'" type="application/octet-stream" sparkle:dsaSignature="'.$updateVersion['signature'].'"/>
					<sparkle:minimumSystemVersion>10.7.0</sparkle:minimumSystemVersion>
				</item>' : '';
		$xml = '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>'.$item.'</channel>
			</rss>';
		return $xml;
	}

	/**
	 * Builds the generic response for all other OS
	 *
	 * @param array $updateVersion
	 * @return string
	 */
	private function buildRegularResponse(array $updateVersion) : string {
		$xml = new \SimpleXMLElement('<owncloudclient/>');
		$updateVersion = array_flip($updateVersion);
		array_walk_recursive($updateVersion, [$xml, 'addChild']);
		return $xml->asXML();
	}

	/**
	 * Builds the response for the update request
	 *
	 * @return string
	 */
	public function buildResponse() : string {
		$updateVersion = $this->getUpdateVersion();
		if($this->isSparkle && $this->platform === 'macos') {
			return $this->buildSparkleResponse($updateVersion);
		}

		return $this->buildRegularResponse($updateVersion);
	}
}
