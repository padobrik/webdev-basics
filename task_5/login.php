<?php
// false == 1, true = 2
function checkCookies() {
    $flag = false;
    $name = '';
    // if button "It is not me" pressed, reset cookies and come back to log in page
    if (isset($_POST['btn2'])) {
        setcookie('name', '', time() - 3600);
        $flag = false;
        showPage($flag, $name);
        return;
    }
    // if cookies globally defined, extract name from cookies and show page "Hello"
    if (isset($_COOKIE['name'])) {
        $flag = true;
        $name = $_COOKIE['name'];
        showPage($flag, $name);
        return;
    }
    // if post name is defined, set cookie expire date to the end of the session
    // with that we could save name showing on the new tab
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        setcookie('name', $name, 0);
        $flag = true;
        showPage($flag, $name);
        return;
    }
    // flag === true, name is empty => log in page
    showPage($flag, $name);
    return;
}

function showPage($flag, $name) {
    if ($flag) {
        $nm = $name;//$_COOKIE['name'];
        echo "<html>
            <head>
                <link rel='stylesheet' href='styles.css'/>
            </head>
            <body>
                <div class='output-container'>
                <p> Hello, $name!<p>
                    <form method='post'>
                        <input type='submit' name='btn2'
                                value='It is not me' class='logout'
                                href = ''/>
                    </form>
                </div>
            </body>
            </html>";
    } else {
        echo file_get_contents("index.html");
    }
}

checkCookies();