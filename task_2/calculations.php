<?php    
    function main($ip, $nameFile) {
        $response = update($ip, $nameFile);
        if ($response != true) {
            $response = add($ip, $nameFile);
        }
        paint_db();
    }

    /**
     * Update rows in db
    */
    function update($ip, $nameFile) {
        global $result, $link;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['IP'] === $ip) {
                $up = $row['NVISITS'] + 1;
                $update = "UPDATE Visits SET NVISITS=$up WHERE IP='$ip' AND WEBPAGE='$nameFile'";
                mysqli_query($link, $update);
                return true;
            }
        }
    }
    
    /**
     * Add counter = 1 if IP meets for the first time
     */
    function add($ip, $nameFile) {
        global $link;
        $add = "INSERT INTO Visits (WEBPAGE, IP, NVISITS) VALUES ('$nameFile','$ip', 1)";
        mysqli_query($link, $add);
    }
    
    /**
     * Draw DB table according to the query
     */
    function paint_db() {
        global $link, $nameFile;
        $result = mysqli_query($link, "SELECT * FROM Visits WHERE WEBPAGE='$nameFile'");
        echo '<table border="1" class="container">';
        echo '<tr>';
        echo '<td class="cell">' . '<b>IP address</b>' . '</td>';
        echo '<td class="cell">' . '<b>Number of visits</b>' . '</td>';
        echo '<td class="cell">' . '<b>Page name</b>' . '</td>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td class="cell">' . $row["IP"] . '</td>';
            echo '<td class="cell">' . $row["NVISITS"] . '</td>';
            echo '<td class="cell">' . $row["WEBPAGE"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        mysqli_close($link);
    }
    
    
    // Server connection
    $ip = $_SERVER['REMOTE_ADDR'];
    $nameFile = ltrim($_SERVER['PHP_SELF'], '/');
    $link = new mysqli('localhost', 'root', '', 'Visits');
    
    // Check connection
    if ($link -> connect_errno) {
        echo "Failed to connect to database: " . $link -> connect_error;
        exit();
      } else {
        echo 'Successfully connected to database';
      }
      
    //Get rows for actual WEBPAGE
    $result = mysqli_query($link, "SELECT * FROM Visits WHERE WEBPAGE='$nameFile'");
    
    main($ip, $nameFile);
?>