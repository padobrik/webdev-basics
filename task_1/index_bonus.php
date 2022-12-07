<?php session_start(); ?>
<?php
    if (!isset($_SESSION['counter'])) {
        $_SESSION['counter'] = 0;
    }
    else {
        $_SESSION['counter']++;
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <title>Page Reload Counter</title>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        You have reloaded this page <?php echo $_SESSION['counter']; ?> times.
    </p>
</body>
</html>