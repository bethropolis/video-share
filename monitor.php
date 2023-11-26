<?php
class Monitor {
    public static function log($videoFile, $startTime, $cacheAvailable, $bufferTimes = null) {
        $fileName = 'monitor_' . md5($videoFile) . '.txt'; // Generate file name based on video file

        $logContent = "File Name: $videoFile\n";
        $logContent .= "Time Opened: " . date("Y-m-d H:i:s", $startTime) . "\n";
        $logContent .= "Full Path: $videoFile\n";
        $logContent .= "Cache Available: " . ($cacheAvailable ? 'Yes' : 'No') . "\n";
        
        if (!empty($bufferTimes)) {
            $logContent .= "Buffering Details:\n";
            foreach ($bufferTimes as $index => $bufferTime) {
                $logContent .= "Buffering $index: " . date("Y-m-d H:i:s", $bufferTime) . "\n";
            }
        }
        // You can include more details or specific metrics as needed
        
        // Write log content to file
        $logFilePath = 'log/' . $fileName;
        file_put_contents($logFilePath, $logContent);
    }
}
?>
