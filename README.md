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
      "version": "3.2.1",
      "versionstring": "Nextcloud Client 3.2.1",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Linux/Nextcloud-3.2.1.AppImage",
      "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
    },
    "win32": {
      "version": "3.2.1.0",
      "versionstring": "Nextcloud Client 3.2.1 (build 1234)",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-3.2.1-x64.msi",
      "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
    },
    "macos": {
      "version": "3.5.2",
      "versionstring": "Nextcloud Client 3.5.2",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Mac/Installer/Nextcloud-3.15.2.pkg",
      "sparkleDownloadUrl": "https://download.nextcloud.com/desktop/releases/Mac/Installer/Nextcloud-3.15.2.pkg.tbz",
      "signature": "AAAaaaAAA001AAA001AAA001AAA001AAA123456001AAA+001AAA01+001AAA001AAA12345+001AAA001AAAA==",
      "length": 123123123
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
      "version": "3.5.0-rc1",
      "versionstring": "Nextcloud Client 3.5.0 RC1",
      "downloadurl": "https://download.nextcloud.com/desktop/releases/Mac/Installer/Nextcloud-3.15.0-rc1.pkg",
      "sparkleDownloadUrl": "https://download.nextcloud.com/desktop/releases/Mac/Installer/Nextcloud-3.15.0-rc1.pkg.tbz",
      "signature": "AAAaaaAAA001AAA001AAA001AAA001AAA123456001AAA+001AAA01+001AAA001AAA12345+001AAA001AAAA==",
      "length": 123123123
    }
  }
}
```

## Development

1. Create the json file in `config/` with the name of the OEM that contains the same entries as the `config.php`, e.g. `nextcloudev.json`.
2. To test this update server locally use `composer start`, which then will run the server on localhost port 1234.
3. Alternativately, you can directly execute: `php -S 0.0.0.0:1234 -t .`.
4. To generate debug logs while developing:
    - Create a `php.ini` in the root folder with the following content:
      ```
      error_log = /Users/camila/client_updater_server/test.log
      log_errors = on
      ```
    - Start the development php server with: `php -S 0.0.0.0:1234 -c php.ini -t .`.

### Desktop client

- For all platforms, with cmake: 
   - Enable `BUILD_UPDATER`.
   - Set `APPLICATION_UPDATE_URL` with `http://0.0.0.0:1234` or the following environment variable when running the client: `export OCC_UPDATE_URL="http://0.0.0.0:1234"`.
- On mac OS: 
   - Build the app bundle and codesign it using [mac-crafter](https://github.com/nextcloud/desktop/tree/master/admin/osx/mac-crafter).
   - Alternativately, with cmake:
     - Enable `BUILD_OWNCLOUD_OSX_BUNDLE`.
     - Set `SPARKLE_LIBRARY`.
     - `codesign` the `Sparkle.framework` and the app bundle.

### Testing
- `*url*?version=4.0.50.20251204&platform=win32&osRelease=windows&osVersion=11&kernelVersion=10.0.26200&oem=Nextcloud&buildArch=x86_64&currentArch=x86_64&versionsuffix=daily&channel=daily&msi=true`

## Deployment

The updater server is deployed via Github webhooks. The state in master is deployed to https://updates.nextcloud.com/client/.
