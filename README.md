ippey/wp-scaffold-wpcept
---
Scaffold wpcept

## Usage
This package implements following command.

### wp scaffold wpcept
Install wpcept and generate files needs for wpcept.
```
wp scaffold wpcept --default-url=http://localhost:8080 --admin-user-name=YOUR_ADMIN_NAME --admin-password=YOUR_ADMIN_PASSWORD --admin-path=/wp-admin
```

OPTIONS
```
[--default-url=<defaultURL>]
 set the url of acceptance.suite.yml

[--admin-user-name=<adminUserName>]
 admin User of WordPress

[--admin-password=<adminPassword>]
 admin password of WordPress

[--admin-path=<adminPath>]
 Path for administrator's page
```

## Install
Installing this package requires WP-CLI v0.23.0 or greater. Update to the latest stable release with ```wp cli update```.  
Once you've done so, you can install this package with wp package install ```Ippey/wp-scaffold-wpcept```.  
