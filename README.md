# Nextcloud Client Updater Server

This is the Nextcloud client update server.

## Ship config of other OEMs

Just create a json file in `config/` with the name of the OEM that contains the same entries as the `config.php`.

If the default `config.php` doesn't hold update information for this OEM, the config is read from the JSON file.

```json
{
  "linux": {
    "version": "2.3.2",
    "versionstring": "Nextcloud Client 2.3.2",
    "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
  },
  "win32": {
    "version": "2.3.2.1",
    "versionstring": "Nextcloud Client 2.3.2 (build 1)",
    "downloadUrl": "https://download.nextcloud.com/desktop/releases/Windows/Nextcloud-2.3.2.1-setup.exe",
    "web": "https://nextcloud.com/install/?pk_campaign=clientupdate#install-clients"
  },
  "macos": {
    "version": "2.2.4.1",
    "versionstring": "Nextcloud Client 2.2.4 (build 1)",
    "downloadUrl": "https://download.nextcloud.com/desktop/releases/Mac/Updates/Nextcloud-2.2.4.1.pkg.tbz",
    "signature": "MCwCFGC3X/fejC/y/3T2X+c8ldDk7pJGAhQoR8v6vtvvV57nIcMNePA+jNRYcw=="
  }
}
```

## Developement
To test this update server locally use `composer start`, which then will run the server on localhost port 1234.
