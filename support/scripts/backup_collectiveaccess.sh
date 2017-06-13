#!/bin/bash
# backup mySQL database, conf, media, setup.php, and cscdb.xml
echo "" >> /tmp/backup_collectiveaccess.out
echo "------------------------------" >> /tmp/backup_collectiveaccess.out
date >> /tmp/backup_collectiveaccess.out
echo "------------------------------" >> /tmp/backup_collectiveaccess.out
cd ~/Dropbox/perry/openshift_backups/collectiveaccess
today=`date '+%Y_%m_%d__%H_%M_%S'`
mkdir $today
cd $today
echo "created folder: $today"
backup_path=$PWD

# backup collectiveaccess mySQL database
suffix='__collectiveaccess.sql'
mysqlbackup=$today$suffix
mysqldump -u causer -pdreU6yGKIE6VCspPv6un collectiveaccess > ${today}__collectiveaccess.sql
echo "backed up mySQL database: collectiveaccess"

# archive media
cd /var/www/html
archive_name=${backup_path}/media.tar.gz
tar -cvzf $archive_name ./media >> /tmp/backup_collectiveaccess.out
echo "archived directory: /var/www/html/media"

# archive app/conf
cd /var/www/html/app
archive_name=${backup_path}/conf.tar.gz
tar -cvzf $archive_name ./conf >> /tmp/backup_collectiveaccess.out
echo "archived directory: /var/www/html/app/conf"

# archive pawtucket
cd /var/www/html
archive_name=${backup_path}/pawtucket.tar.gz
tar -cvzf $archive_name ./pawtucket >> /tmp/backup_collectiveaccess.out
echo "archived directory: /var/www/html/pawtucket"

# backup setup.php
cp /var/www/html/setup.php $backup_path
echo "backed up: setup.php"

# backup cscdb.xml
cp /var/www/html/install/profiles/xml/cscdb.xml $backup_path
echo "backed up: cscdb.xml"

# archive a snapshot of the entire collectiveaccess installation
cd /var/www
archive_name=${backup_path}/html.tar.gz
tar --exclude='./html/app/tmp' -cvzf $archive_name ./html >> /tmp/backup_collectiveaccess.out
echo "archived directory: /var/www/html"


