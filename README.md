simple,

install `xampp` version 3+

then place the file code on your `htdocs` folder

> you may need to configure your firewall so that port 80 can be forwarded to your LAN

and edit the `config.php` file

```php
if (!defined('VIDEOS_FOLDER')) define('VIDEOS_FOLDER', 'C:/Users/Administrator/Videos/');
```

