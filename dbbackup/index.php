<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
 <head> <title>Db Backup-Perfect website Backup Script</title></head>
<body>
<?php
require_once('../config.php');

$connbackup = new mysqli($backuphost, $backupuser, $backuppass, $backupdb);

if ($connbackup->connect_error) {
    die("connection failed" . $conn->connect_error);
} else{
echo "Target Backup database Connected Successfully<br>";
}

$conn = new mysqli($mysqlhost, $mysqluser, $mysqlpass, $mysqldb);

if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
} else{
echo "Script database Connected Successfully<br>";
}

$filename = 'dbbackup' . time() . '.sql.gz';

exec('mysqldump --user='.$backupuser.' --password='.$backuppass.' --host='.$backuphost.' '.$backupdb.' | gzip -9 > '.$filename);
$file_hash = md5_file($filename);

$query = "SELECT checksum FROM dbbackup WHERE checksum = '$file_hash' ";

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
        $sql = "INSERT INTO dbbackup (filename, checksum , time) VALUES ('$filename', '$file_hash' ,'" . date("Y-m-d H:i:s") . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $filecountsql = "SELECT id from dbbackup";
        if ($filecountchecker = mysqli_query($conn, $filecountsql)) {
            echo $filecount = mysqli_num_rows($filecountchecker);
            if ($filecount > $filecountlimit) {
                echo "<br>Action here";
                $result = $conn->query('SELECT filename FROM dbbackup ORDER BY id LIMIT 1');
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {                  
                        unlink($row["filename"]);
                        $conn->query('DELETE FROM dbbackup ORDER BY id  ASC LIMIT 1');
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

?>

</body>

</html>