<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display User Form</title>
    <style>
        .image_class {
            width: 50px;
            height: 50px;
        }
        .cell {
            padding: 5px 10px;
        }
        .container{
            margin: 60px auto;
            border-collapse: collapse;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <?php

    // Check if any posted variables are empty
    function checkPost($required) {
        $error = false;
        foreach($required as $field) {
            if (empty($_POST[$field])) {
                $error = true;
            }
        }
        
        if ($_FILES['file']['error'] == 4) {
            $error = true;
        }
        if ($error) {
            echo "All fields are required";
            exit();
        } else {
            echo "Proceed...";
        }
    }

    function checkFileUpload($path_image, $path) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path_image . $path)) {
            if (!file_exists($path_image . $path)) {
                echo 'Failed to upload image to database';
            }
        }
    }

    error_reporting(-1); // debug deeply
    $link = new mysqli('localhost', 'root', '', 'task3');
    if ($link -> connect_errno) {
        echo "Failed to connect to database: " . $link -> connect_error;
        exit();
    } else {
        echo 'Successfully connected to database';
        echo '<br>';
    }
    
    $required = array('first_name', 'last_name', 'birthday', 'group', 'gender', 'text');
    checkPost($required);

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $bday = $_POST['birthday'];
    $group = $_POST['group'];
    $photo = $_FILES['file'];
    $gender = $_POST['gender'];
    $info = $_POST['text'];

    $path_image = "./student_photos/";
    $path = uniqid() . '.jpg';
    checkFileUpload($path_image, $path);

        // TODO multiline string + check parameters
    $add = "INSERT INTO students (first_name, last_name, birthday, group_no, photo, gender, info) VALUES ('$firstName', '$lastName', '$bday', '$group', '$path', '$gender', '$info')";
    mysqli_query($link, $add);
    echo mysqli_error($link);

    $result_all = mysqli_query($link, "SELECT * FROM students");

    echo '<table border="1" class="container">';
    echo '<thead>';
    echo '<tr>';
    echo '<td class="cell">' . "First name" . '</td>';
    echo '<td class="cell">' . "Last name" . '</td>';
    echo '<td class="cell">' . "Date of Birth" . '</td>';
    echo '<td class="cell">' . "Group No" . '</td>';
    echo '<td class="cell">' . "Sex" . '</td>';
    echo '<td class="cell">' . "Additional info" . '</td>';
    echo '<td class="cell">' . "Photo" . '</td>';
    echo '</tr>';
    echo '</thead>';
    while ($row = mysqli_fetch_assoc($result_all)) {

        $newrow = $row['info'];
        $newrow = explode("\n", $newrow);
        $newrow = implode('<br>', $newrow);
        $newrow = substr($newrow, 0);

        echo '<tr>';
        echo '<td class="cell">' . $row["first_name"] . '</td>';
        echo '<td class="cell">' . $row["last_name"] . '</td>';
        echo '<td class="cell">' . $row["birthday"] . '</td>';
        echo '<td class="cell">' . $row["group_no"] . '</td>';
        echo '<td class="cell">' . $row["gender"] . '</td>';
        echo '<td class="cell">' . $newrow . '</td>';
        echo '<td class="cell">' . '<img src="'. $path_image . $row["photo"] .'" alt="" class="image_class"/>' . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    mysqli_close($link);
    ?>
</body>

</html>