Do you want to share videos in your local folder with people on your LAN?
cause that's what this does

simple,

1. install `xampp` version 3+

2. clone this repository into your `htdocs` folder
   ```
   git clone https://github.com/bethropolis/video-stream public
   ```
  > The compiled web interface uses `public` folder that's why we are renaming the folder.

3. Edit the `config.php` file
   
    ```php
     if (!defined('VIDEOS_FOLDER')) define('VIDEOS_FOLDER', 'C:/Users/Administrator/Videos/');
    ```


4. you may need to configure your firewall so that port 80 can be forwarded to your LAN



5. get your LAN ip address and share it to those in your network
   ```bash
   ipconfig
   ```

    > example address is `192.168.9.101/public` (ipv4)



Lincence [MIT](LICENSE)