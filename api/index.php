<?php
require '../config.php'; // Include config file
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
function getVideos($dir, $relativePath = '', $recursive = true) {
    $response = [];

    $videos = glob($dir . '/*.{mp4,mkv}', GLOB_BRACE); // Fetch videos in current directory
    natsort($videos); // Sort subdirectories by natural order
    foreach ($videos as $video) {
        $videoName = basename($video);
        $videoPath = $relativePath !== '' ? "$relativePath/$videoName" : $videoName;
        $response[] = ['type' => 'file', 'name' => $videoName, 'path' => $videoPath];
    }

    if (!$recursive) {
        return $response;
    }
    
    $subdirs = glob($dir . '/*', GLOB_ONLYDIR); // Fetch subdirectories
    natsort($subdirs); // Sort subdirectories by natural order
    foreach ($subdirs as $subdir) {
        $subdirName = basename($subdir);
        $subdirPath = $relativePath !== '' ? "$relativePath/$subdirName" : $subdirName;
        $response[] = [
            'type' => 'directory',
            'name' => $subdirName,
            'path' => $subdirPath,
            'content' => getVideos($subdir, $subdirPath), // Recursive call for subdirectories
        ];
    }
    return $response;
}


$videoRoot = VIDEOS_FOLDER; // Your video root directory
if (isset($_GET['path'])) {
    $requestedPath = $_GET['path'];
    $folderPath = $videoRoot . '/' . $requestedPath;

    if (is_dir($folderPath)) {
        $videoList = getVideos($folderPath, $requestedPath);
        echo json_encode($videoList, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['error' => 'Invalid folder path'], JSON_PRETTY_PRINT);
    }
} else {
    $videoList = getVideos($videoRoot);
    echo json_encode($videoList, JSON_PRETTY_PRINT);
}

?>
