<?php

/**
 * SPDX-FileCopyrightText: 2019 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: MIT
 */

namespace ClientUpdateServer;

class Config {
	/** @var array */
	private $configArray = [];

	/**
	 * @param string $configFile
	 */
	public function __construct($configFile) {
		$this->configArray = require_once $configFile;
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get($key) {
		return $this->configArray[$key];
	}
}
