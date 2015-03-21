# Perfect Website Backup Script

Perfect Website Backup is nice script to backup your website. It take all the files and databse.

  - File Backup
  - Database Backup
  - Automatic Backup Using Cron Job
  - No duplicalicate Backup. It check the checksum of the file
  - Store new backup and delete previous backup

### Version
1.0.0

### How to install

1. Suppose your site is www.example.com
2. Open a subdomain backup.example.com . define it's root directory carefully. Suppose you want to take the backup of www.example.com . It's root directory is /home/action/public_html . So you can set the root directory of backup.example.com to /home/action/backup
3. Clone the perfect website backup script into /home/action/backup
4. Open your site http://backup.example.com. You can see here a form. You have to open a database and user for perfect website backup script. Input this details on Database User, password and host field. Then we have to input the database details of target website which backup u want to take.This details you have to input on the Backup Host, user, password and database name.
5. on the location field you have to input the location of the target website. As we want to take the backup of www.example.com. So it will be /home/action/public_html/ . Do't forget to use / after the directory.
6. Bacup File Count: Here u have to input how many backup do u want to store. now click on the submit button.
7. Go to the http://backup.example.com. You can see all details what to do if u want to add cronjob. 
Add this command on the cronjob. On the cronjob you can set when you need to take backup.
```sh
$ php /home/action/backup/filebackup/index.php > /dev/null
```
```sh
$ php /home/action/backup/dbbackup/index.php > /dev/null
```


### Development

Want to contribute? Great!
Fork the repo, change the code and send me pull request.

###Author
Mashpy

###License
GNU