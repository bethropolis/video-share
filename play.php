<html>
<head>
    <title>Play Video</title>
</head>
<body>
    <?php
    $requestedVideo = $_GET['video'];
    echo "<video width='640' height='480' controls>
            <source src='proxy.php?video=$requestedVideo' type='video/mp4'>
          Your browser does not support the video tag.
          </video>";
    ?>
</body>
</html>
