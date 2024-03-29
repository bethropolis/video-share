<?php
require 'config.php'; // Include config file
require_once 'monitor.php'; // Include Monitor class file
require_once 'vendor/autoload.php'; // Include Composer autoload if necessary

header('Access-Control-Allow-Origin: *');
use Micilini\VideoStream\VideoStream;

$videoRoot = VIDEOS_FOLDER; // Your video root directory

$requestedVideo = str_replace('../', '', $_GET['video']); // Prevent directory traversal


$videoFile = $videoRoot . '/' . $requestedVideo;

$cacheFile = 'cached_videos/' . $requestedVideo; // Path to cache directory

$startTime = time(); // Record start time

if (file_exists($videoFile) && strpos($videoFile, $videoRoot) === 0) {
    $cacheAvailable = file_exists($cacheFile);
    $fileSize = filesize($videoFile);

    $videoStream = new VideoStream();
        $options = [
            'is_localPath' => true,
            'is_https' => false,
            'video_size' => $fileSize,
            'video_buffer' => 512,
            'content_type' => 'video/mp4',
            'cache_control' => 'max-age=2592000, public',
            'expires' => gmdate('D, d M Y H:i:s', time() + 2592000) . ' GMT',
            'last_modified' => gmdate('D, d M Y H:i:s', @filemtime($videoFile)) . ' GMT',
        ];
        $videoStream->streamVideo($videoFile, $options);
    

    // Log video streaming details using Monitor class
    Monitor::log($videoFile, $startTime, $cacheAvailable);
} else {
    echo 'Video not found.';
}
