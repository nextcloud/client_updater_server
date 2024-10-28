<!--
  - SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
  - SPDX-License-Identifier: AGPL-3.0-or-later
-->
# Nextcloud Client Updater Server

[![REUSE status](https://api.reuse.software/badge/github.com/nextcloud/client_updater_server)](https://api.reuse.software/info/github.com/nextcloud/client_updater_server)

This is the Nextcloud client update server.

## Ship config of other OEMs

Just create a json file in `config/` with the name of the OEM that contains the same entries as the `config.php`.

If the default `config.php` doesn't hold update information for this OEM, the config is read from the JSON file.

```json
{
  "stable": {
    "release": "2022-01-01 13:00",
    "linux": {
      "version": "2.3.2",
      "versionstring": "Nextcloud Client 2.3.2",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Linux/Nextcloud-2.3.2.1-setup.AppImage",
      "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
    },
    "win32": {
      "version": "2.3.2.1",
      "versionstring": "Nextcloud Client 2.3.2 (build 1)",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-2.3.2.1-setup.exe",
      "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
    },
    "macos": {
      "version": "2.2.4.1",
      "versionstring": "Nextcloud Client 2.2.4 (build 1)",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-2.2.4.1.pkg.tbz",
      "signature": "MCwCFGC3X/fejC/y/3T2X+c8ldDk7pJGAhQoR8v6vtvvV57nIcMNePA+jNRYcw=="
    }
  },
  "beta": {
    "release": "2022-01-27 14:31",
    "linux": {
      "version": "3.5.6-rc1",
      "versionstring": "Nextcloud Client 3.5.6 RC1",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Linux/Nextcloud-3.5.6-rc1-setup.AppImage",
      "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
    },
    "win32": {
      "version": "3.5.6-rc1",
      "versionstring": "Nextcloud Client 3.5.6 RC1",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-3.5.6-rc1-setup.exe",
      "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
    },
    "macos": {
      "version": "3.5.6-rc1",
      "versionstring": "Nextcloud Client 3.5.6 RC1",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-3.5.6-rc1-pkg.tbz",
      "signature": "MCwCFGC3X/fejC/y/3T2X+c8ldDk7pJGAhQoR8v6vtvvV57nIcMNePA+jNRYcw=="
    }
  }
}
```

## Developement
To test this update server locally use `composer start`, which then will run the server on localhost port 1234.

## Deployment

The updater server is deployed via Github webhooks. The state in master is deployed to https://updates.nextcloud.com/client/.
