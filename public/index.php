<?php

require_once __DIR__ . '/../autoload.php';

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Creationlt</title>
</head>
<body>
    <h2>Upload file</h2>
    <form action="../App/Libraries/Core.php" method="post" enctype="multipart/form-data">
        <label for="fileName">Choose file to upload:</label>
        <input type="file" name="fileName" accept=".csv, .xml, .json">
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>
HTML;
