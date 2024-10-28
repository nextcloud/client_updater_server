<?php

/**
 * SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
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
	/** @var string */
	private $osRelease;
	/** @var string */
	private $osVersion;
	/** @var string */
	private $kernelVersion;
	/** @var string */
	private $channel;
	/** @var bool */
	private $isSparkle;
    /** @var bool */
    private $isFileProvider;
	/** @var array */
	private $config;

	public function __construct(string $oem,
								string $platform,
								string $version,
								string $osRelease,
								string $osVersion,
								string $kernelVersion,
								string $channel,
								bool $isSparkle,
                                bool $isFileProvider,
								array $config) {
		$this->oem = $oem;
		$this->platform = $platform;
		$this->version = $version;
		$this->osRelease = $osRelease;
		$this->osVersion = $osVersion;
		$this->kernelVersion = $kernelVersion;
		$this->channel = $channel;
		$this->isSparkle = $isSparkle;
        $this->isFileProvider = $isFileProvider;
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

		if(!isset($this->config[$this->oem][$this->channel][$this->platform])) {
			return [];
		}

		// if outdated platform, hand out latest stable-qt5, no daily/beta possible
		if ($this->checkOldPlatform()) {
            $stable = $this->config[$this->oem]['stable-qt5'][$this->platform];
            $beta = null;
            $daily = null;
        } else if (version_compare($this->osVersion, '12.0', '<') &&
                   version_compare($this->version, '3.14.0', '<') &&
                   version_compare($this->config[$this->oem]['stable'][$this->platform]['version'], '3.14.0', '==')) {
            // Skip 3.14.0 for macOS < 12 when updating as we have an issue with the system requirement settings
            // Serve the prior version instead in the meantime (3.13.4)
            $stable = $this->config[$this->oem]['stable-qt5'][$this->platform];
            $beta = $this->config[$this->oem]['beta'][$this->platform];
            $daily = $this->config[$this->oem]['daily'][$this->platform];
		} else {
			$stable = $this->config[$this->oem]['stable'][$this->platform];
			$beta = $this->config[$this->oem]['beta'][$this->platform];
			$daily = $this->config[$this->oem]['daily'][$this->platform];
		}

		if (isset($daily) && $this->channel == 'daily' && (version_compare($this->version, $daily['version']) == -1)) {
			return $daily;
		}

		if (isset($beta) && $this->channel == 'beta' && (version_compare($stable['version'], $beta['version']) == -1 ||
			($this->platform === 'macos' && $this->isSparkle === true))) {
			return $beta;
		}

		if (version_compare($this->version, $stable['version']) == -1 || ($this->platform === 'macos' && $this->isSparkle === true)) {
			return $stable;
		}

		return [];
	}

	private function checkOldPlatform(): bool {
		// Outdated platforms:
		// - macOS < 11
		// - Win < 10
		// - Win 10 (build number < 1809)
		// - Win 11 (build number < 17764)
		// - Ubuntu <22.04
		// - openSuse <15.5
		// - RHEL <9.2

		// Mac < 11
		if ($this->platform === "macos" && version_compare($this->osVersion, "11") == -1) {
			return true;
		}

		// Windows <10
		if ($this->platform === "win32" && version_compare($this->osVersion, "10") == -1) {
			return true;
		}

		// Windows 10 (build number < 1809)
		if ($this->platform === "win32" && version_compare($this->osVersion, "10") == 0 && version_compare($this->kernelVersion, '10.0.1809') == -1) {
			return true;
		}

		// - Win 11 (build number < 17764)
		if ($this->platform === "win32" && version_compare($this->osVersion, "11") == 0 && version_compare($this->kernelVersion, '10.0.17764') == -1) {
			return true;
		}

		// - Ubuntu <22.04
		if ($this->platform === "linux" && $this->osRelease == "ubuntu" && version_compare($this->osVersion, '22.04') == -1) {
			return true;
		}

		// - RHEL <9.2
		if ($this->platform === "linux" && $this->osRelease == "rhel" && version_compare($this->osVersion, '9.2') == -1) {
			return true;
		}


		// - openSuse <15.5
		if ($this->platform === "linux" && $this->osRelease == "opensuse-leap" && version_compare($this->osVersion, '15.5') == -1) {
			return true;
		}

		return false;
	}

	/**
	 * Returns the current time stamp
	 * @return string
	 */
	protected function getCurrentTimeStamp() : string {
		return (new \DateTime())->format('D, j F y H:m:s O');
	}

	/**
	 * Convenience functions to get specific file provider or standard client update information
	 */
	private function getSparkleUpdateUrl(array $updateVersion) : string {
		$updateUrlKey = $this->isFileProvider ? 'fileProviderSparkleDownloadUrl' : 'sparkleDownloadUrl';
		return $updateVersion[$updateUrlKey];
	}

	private function getSparkleUpdateSignature(array $updateVersion) : string {
		$updateSignatureKey = $this->isFileProvider ? 'fileProviderSignature' : 'signature';
		return $updateVersion[$updateSignatureKey];
	}

	private function getSparkleUpdateLength(array $updateVersion) : int {
		$updateLengthKey = $this->isFileProvider ? 'fileProviderLength' : 'length';
		return $updateVersion[$updateLengthKey];
	}

	private function getSparkleVersionString(array $updateVersion) : string {
		$updateLengthKey = $this->isFileProvider ? 'fileProviderVersionString' : 'versionstring';
		return $updateVersion[$updateLengthKey];
	}

	/**
	 * Builds the response for Sparkle (used by the Mac updater)
	 *
	 * @param array $updateVersion
	 * @return string
	 */
	private function buildSparkleResponse(array $updateVersion) : string {
		$sparkleUrl = $this->getSparkleUpdateUrl($updateVersion);
		$versionString = $this->getSparkleVersionString($updateVersion);
		$sparkleSignature = $this->getSparkleUpdateSignature($updateVersion);
		$sparkleLength = $this->getSparkleUpdateLength($updateVersion);
		
		$item = !empty($updateVersion) ? '
		<item>
			<title>'.$versionString.'</title>
			<pubDate>'.$this->getCurrentTimeStamp().'</pubDate>
			<enclosure url="'.$sparkleUrl.'" sparkle:version="'.$updateVersion['version'].'" type="application/octet-stream" sparkle:edSignature="'.$sparkleSignature.'" length="'.$sparkleLength.'"/>
			<sparkle:minimumSystemVersion>11.0</sparkle:minimumSystemVersion>
		</item>' : '';
		
		return '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>Download Channel</title>
		<description>Most recent changes with links to updates.</description>
		<language>en</language>'.$item.'
	</channel>
</rss>';
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
