<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
 <head> <title>File Backup-Perfect website Backup Script</title></head>

<body>
<?php
require_once('../config.php');

if (!is_dir($location)) {
    echo "$location Directory is not exists<br>";
} else {
$conn = new mysqli($mysqlhost, $mysqluser, $mysqlpass, $mysqldb);

if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
//echo "Connected Successfully\n";

$filename = 'filebackup' . time() . '.zip';
  
echo exec('zip -r ' . $filename . ' ' . $location . '/.'.$exclude);
 $file_hash = md5_file($filename);

$query = "SELECT checksum FROM filebackup WHERE checksum = '$file_hash' ";

echo "checking sum <br>";


if ($result = mysqli_query($conn, $query)) {
    
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        echo "There is row";
        unlink($filename);
    }
    
    else {
        echo "There is no row <br>";
        date_default_timezone_set('Asia/Dhaka');
        $sql = "INSERT INTO filebackup (filename, checksum , time) VALUES ('$filename', '$file_hash' ,'" . date("Y-m-d H:i:s") . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $filecountsql = "SELECT id from filebackup";
        if ($filecountchecker = mysqli_query($conn, $filecountsql)) {
            echo $filecount = mysqli_num_rows($filecountchecker);
            if ($filecount > $filecountlimit) {
                echo "<br>Action here<br>";
                $result = $conn->query('SELECT filename FROM filebackup ORDER BY id LIMIT 1');
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    
                   echo  $row["filename"] ;
                        unlink($row["filename"]);
                        $conn->query('DELETE FROM filebackup ORDER BY id  ASC LIMIT 1');
                        echo "<br>deleted</br>";
                    }
                } else {
                    echo "0 results <br>";
                }
                
            } else {
                echo "<br>no action ";
            }
        }
        
        $conn->close();
    }
}
}
?>

</body>

</html>