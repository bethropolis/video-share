<?php
function displayVideos($dir, $relativePath = '')
{
    $videos = glob($dir . '/*.{mp4,mkv}', GLOB_BRACE);
    natsort($videos); // Sort videos by natural order
    foreach ($videos as $video) {
        $videoName = basename($video);
        $videoPath = $relativePath !== '' ? "$relativePath/$videoName" : $videoName;
        echo "<li><a href='play.php?video=$videoPath'>$videoPath</a></li>";
    }

    $subdirs = glob($dir . '/*', GLOB_ONLYDIR); // Fetch subdirectories
    natsort($subdirs); // Sort subdirectories by natural order
    foreach ($subdirs as $subdir) {
        $subdirName = basename($subdir);
        $subdirPath = $relativePath !== '' ? "$relativePath/$subdirName" : $subdirName;
        echo "<li><strong>$subdirName:</strong>";
        echo "<ul>";
        displayVideos($subdir, $subdirPath); // Recursive call for subdirectories
        echo "</ul></li>";
    }
}

$videoRoot = 'C:/Users/Administrator/Videos'; // Your video root directory
echo "<html><head><title>Video Server</title></head><body><h1>Available Videos:</h1><ul>";
displayVideos($videoRoot);
echo "</ul></body></html>";
?>
