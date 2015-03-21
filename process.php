<html>
 <head> <title>Process-Perfect website Backup Script</title></head>
<body>
<?php
$excludezip = (isset($_POST['excludezip']) ? $_POST['excludezip'] : '');
$excludetar = (isset($_POST['excludetar']) ? $_POST['excludetar'] : '');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["host"])) {
        echo $nameErr = "Host name is required<br>";
    }
    
    if (empty($_POST["dbuser"])) {
        echo $dbuserErr = "dbuser is required<br>";
    }
    if (empty($_POST["dbpass"])) {
        echo $dbpassErr = "dbpass is required<br>";
    }
    
    if (empty($_POST["dbname"])) {
        echo $dbnameErr = "dbname is required<br>";
    }
    
    
    if (empty($_POST["backuphost"])) {
        echo $backuphostErr = "backuphost is required<br>";
    }
    if (empty($_POST["backupuser"])) {
        echo $backupuserErr = "backupuser is required<br>";
    }
    
    if (empty($_POST["backuppass"])) {
        echo $backuppassErr = "backuppass is required<br>";
    }
    
    if (empty($_POST["backupdb"])) {
        echo $backupdbErr = "backupdb is required<br>";
    }
    if (empty($_POST["location"])) {
        echo $locationErr = "location is required<br>";
    }
    
    
}

if (empty($_POST["filecountlimit"])) {
    echo $filecountlimitErr = "filecountlimit is required<br>";
} else {
    if (!is_dir($_POST["location"])) {
        echo "This Directory is not exists<br>";
    } else {
        
        if (!empty($_POST['host'])) {
            $conn = @mysqli_connect($_POST['host'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbname']);
            
            if (mysqli_connect_error()) {
                echo "something wrong";
            } else {
                $myfile = fopen("config.php", "w") or die("Unable to open file!");
                $txt = '<?php
$mysqlhost      = "' . $_POST['host'] . '";
$mysqluser      = "' . $_POST['dbuser'] . '";
$mysqlpass      = "' . $_POST['dbpass'] . '";
$mysqldb        = "' . $_POST['dbname'] . '";

$backuphost      = "' . $_POST['backuphost'] . '";
$backupuser      = "' . $_POST['backupuser'] . '";
$backuppass      = "' . $_POST['backuppass'] . '";
$backupdb        = "' . $_POST['backupdb'] . '";

$location       = "' . $_POST['location'] . '";
$filecountlimit = "' . $_POST['filecountlimit'] . '";

$zip = \'' . $excludezip . '\';
$targz = \'' . $excludetar . '\';
$exclude = $zip.$targz ;
';
                
                fwrite($myfile, $txt);
                fclose($myfile);
                echo "</br>successfully updated</br>";
                
                $sql = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `omnibl_servereditor`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbbackup`
--

CREATE TABLE IF NOT EXISTS `dbbackup` (
  `id` int(10) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `checksum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filebackup`
--

CREATE TABLE IF NOT EXISTS `filebackup` (
  `id` int(10) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `checksum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbbackup`
--
ALTER TABLE `dbbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filebackup`
--
ALTER TABLE `filebackup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbbackup`
--
ALTER TABLE `dbbackup`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `filebackup`
--
ALTER TABLE `filebackup`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;';
                
                if ($conn->multi_query($sql) === TRUE) {
                    echo "Table created successfully";
                } else {
                    echo "Error creating table: " . $conn->error;
                }
                
                $conn->close();
                
            }
        }
    }
}
?>
 <a href="/">Back</a> 
</body>
</html> 