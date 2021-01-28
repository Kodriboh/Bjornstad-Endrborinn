<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome To Bjornstad</h1>

    <p><?php echo htmlspecialchars($name); ?></p>
    <ul>
        <?php foreach ($colors as $color) :?>
            <li><?php echo htmlspecialchars($color)?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>