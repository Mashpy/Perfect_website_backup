<title>Perfect website Backup Script-home</title>
<?php
require_once('config.php');

$conn = @mysqli_connect($mysqlhost, $mysqluser, $mysqlpass, $mysqldb);

if (!empty($mysqlhost) && !empty($backuphost)) {
    if (mysqli_connect_error()) {
        require_once('form.php');
    } else {
        $bacupconn = @mysqli_connect($backuphost, $backupuser, $backuppass, $backupdb);
        if (mysqli_connect_error()) {
            require_once('form.php');
        } else {
            echo "connection successful.<br>";
            $filebackuplink  = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]filebackup";
            $dbbackuplink    = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]dbbackup";
            $currentlocation = exec('pwd');
            echo " You can take file backup clicking on this link <a href='" . $filebackuplink . "'>$filebackuplink</a> <br> <br>

You can take Database file backup clicking on this link <a href='" . $dbbackuplink . "'>$dbbackuplink</a><br><br>

You can add cron job to take automatic backup . Add this command for file backup </br>
<b>php $currentlocation/filebackup/index.php > /dev/null</b></br></br>
Add this command for database backup </br>
<b>php $currentlocation/dbbackup/index.php > /dev/null</b></br>
";
         
        }
    }
} else {
    require_once('form.php');
}

?>