<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task 3. Student form</title>
    <style>
        .container{
            margin: 60px auto;
            max-width: 50%;
            background: #f8f8f8;
            padding: 30px 30px;
            border-radius: 15px;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <script type='text/javascript'>
        function preview() {
            thumb.src=URL.createObjectURL(event.target.files[0]);
            }
    </script>   

    <form action="display.php" method="POST" class="container" enctype="multipart/form-data">
     <h1>Add new student</h1>
        <p>First Name</p>
        <input type="text" name="first_name"/>

        <p>Last Name</p>
        <input type="text" name="last_name"/>

        <p>Date of Birth</p>
        <input type="date" id="birthday" name="birthday">

        <p>Sex</p>
        <input type="radio" value="male" name="gender" id="man"/>
        <label for="man">Male</label>
        <input type="radio" value="female" name="gender" id="woman"/>
        <label for="woman">Female</label>

        <p>Group Number</p>
        <input type="text" name="group"/>
        
        <p>Photo</p>
        <input type="file" onchange="preview()" name='file' id="file" value="file"/>
        <img id="name" src="" width="150px"/>

        <p>Additional information</p>
        <textarea name="text" id="" cols="30" rows="10"></textarea>

        <br></br>
        <hr/>
        <button type="submit" name="send">Send</button>
        <button type="reset">Clear</button>
    </form>
</body>
</html>