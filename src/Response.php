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

		// if legacy platform, hand out its dedicated stable version; no daily/beta/enterprise
		$legacyChannel = $this->getLegacyChannel();
		if ($legacyChannel !== null) {
			if (!isset($this->config[$this->oem][$legacyChannel][$this->platform])) {
				return [];
			}
			$stable = $this->config[$this->oem][$legacyChannel][$this->platform];
			$beta = null;
			$daily = null;
			$enterprise = null;
		} else {
			$stable = $this->config[$this->oem]['stable'][$this->platform];
			$beta = $this->config[$this->oem]['beta'][$this->platform];
			$daily = $this->config[$this->oem]['daily'][$this->platform];
			$enterprise = $this->config[$this->oem]['enterprise'][$this->platform];
		}

		$isMacOs = ($this->platform === 'macos' && $this->isSparkle === true);

		if (isset($daily) && $this->channel == 'daily' && (version_compare($this->version, $daily['version']) == -1)) {
			return $daily;
		}

		if (isset($beta) && $this->channel == 'beta' && (version_compare($stable['version'], $beta['version']) == -1 || $isMacOs)) {
			return $beta;
		}

		if (isset($enterprise) && $this->channel == 'enterprise' && (version_compare($this->version, $enterprise['version']) == -1 || $isMacOs)) {
			return $enterprise;
		}

		if (version_compare($this->version, $stable['version']) == -1 || $isMacOs) {
			return $stable;
		}

		return [];
	}

	private function getLegacyChannel(): ?string {
		// Outdated platforms (Qt5 era):
		// - macOS < 11
		// - Win < 10
		// - Win 10 (build number < 1809)
		// - Win 11 (build number < 17764)
		// - Ubuntu <22.04
		// - openSuse <15.5
		// - RHEL <9.2

		// Mac < 11
		if ($this->platform === "macos" && version_compare($this->osVersion, "11") == -1) {
			return 'stable-qt5';
		}

		// macOS 11/12 — not compatible with Qt6.10 (required by current stable)
		if ($this->platform === "macos" && version_compare($this->osVersion, "13") == -1) {
			return 'stable-qt6.9';
		}

		// Windows <10
		if ($this->platform === "win32" && version_compare($this->osVersion, "10") == -1) {
			return 'stable-qt5';
		}

		// Windows 10 (build number < 1809)
		if ($this->platform === "win32" && version_compare($this->osVersion, "10") == 0 && version_compare($this->kernelVersion, '10.0.1809') == -1) {
			return 'stable-qt5';
		}

		// - Win 11 (build number < 17764)
		if ($this->platform === "win32" && version_compare($this->osVersion, "11") == 0 && version_compare($this->kernelVersion, '10.0.17764') == -1) {
			return 'stable-qt5';
		}

		// - Ubuntu <22.04
		if ($this->platform === "linux" && $this->osRelease == "ubuntu" && version_compare($this->osVersion, '22.04') == -1) {
			return 'stable-qt5';
		}

		// - RHEL <9.2
		if ($this->platform === "linux" && $this->osRelease == "rhel" && version_compare($this->osVersion, '9.2') == -1) {
			return 'stable-qt5';
		}


		// - openSuse <15.5
		if ($this->platform === "linux" && $this->osRelease == "opensuse-leap" && version_compare($this->osVersion, '15.5') == -1) {
			return 'stable-qt5';
		}

		return null;
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
			<enclosure url="'.$sparkleUrl.'" sparkle:version="'.$updateVersion['version'].'" type="application/octet-stream" sparkle:installationType="package" sparkle:edSignature="'.$sparkleSignature.'" length="'.$sparkleLength.'"/>
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
