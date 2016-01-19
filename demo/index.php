<!DOCTYPE html>
<html>
<head>
    <title>Imagine Focal Resizer Demo</title>
    <style>
    body {
        font-family: arial,helvetica;
    }

    input[type="text"] {
        width: 3em;
    }
    </style>
</head>
<body>

<h2>Imagine Focal Resizer</h2>

<p>The focal point is by default in the center of the insect's eye</p>

<form action="resize.php" method="post">
    <label>Width: <input type="text" name="width" value="<?= isset($_GET['width']) ? $_GET['width'] : '1920' ?>"></label>
    <label>Height: <input type="text" name="height" value="<?= isset($_GET['height']) ? $_GET['height'] : '1280' ?>"></label>
    <label>Focal X: <input type="text" name="focalx" value="<?= isset($_GET['focalx']) ? $_GET['focalx'] : '0.28' ?>"></label>
    <label>Focal Y: <input type="text" name="focaly" value="<?= isset($_GET['focaly']) ? $_GET['focaly'] : '-0.2' ?>"></label>
    <input type="submit" value="resize">
    <a href="/">Reset</a>
</form>
<br />

<img src="dragonfly<?= isset($_GET['width']) ? '-resized' : '' ?>.jpg?<?= time() ?>">

</body>
</html>