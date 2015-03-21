<form action="process.php" method="post">
Host: <input type="text" name="host"><br>
Database User: <input type="text" name="dbuser"><br>
Database Password: <input type="text" name="dbpass"><br>
Database Name: <input type="text" name="dbname"><br>  
Backup Host: <input type="text" name="backuphost"><br>
Backup User: <input type="text" name="backupuser"><br>
Backup Password: <input type="text" name="backuppass"><br>
Backup Database Name: <input type="text" name="backupdb"><br>  
Location: <input type="text" name="location"><br>(Current Location: <?php echo exec('pwd') ?>)<br> <br>
Bacup File Count: <input type="text" name="filecountlimit"><br>  
<input type="checkbox" name="excludezip" value=' -x "*.zip*"'>Exclude Zip file<br>   
<input type="checkbox" name="excludetar" value=' -x "*.tar.gz*"'>Exclude Tar gz file<br>   
<input type="submit">
</form>