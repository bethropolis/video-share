<?php
// define videos folder path
if (!defined('VIDEOS_FOLDER')) define('VIDEOS_FOLDER', '');
// define directory to be served
if (!defined('DIR_TO_SERVE')) define('DIR_TO_SERVE', '.');
// print the directory to be served
echo DIR_TO_SERVE;