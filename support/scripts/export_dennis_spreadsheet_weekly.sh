#!/bin/bash
# load export mapping
echo ''
echo '...loading export mapping in CollectiveAccess'
cd /var/www/html/support
./bin/caUtils load-export-mapping --file=dennis_export/mappings/dennis_spreadsheet_mapping.xlsx

# backup mySQL database
echo ''
echo '...backing up mySQL database for CollectiveAccess'
cd ~/backup
today=`date '+%Y_%m_%d__%H_%M_%S'`
today_short=`date '+%Y_%m_%d'`
mysqldump -u causer -pdreU6yGKIE6VCspPv6un collectiveaccess > ~/backup/${today}__collectiveaccess.sql

# export data
echo ''
echo '...exporting data from CollectiveAccess to CSV file'
cd /var/www/html/support
./bin/caUtils export-data --file=dennis_export/data/${today_short}__Artifact_Donation_and_Acquisitions.csv --mapping=export_dennis_spreadsheet --log=dennis_export/log --search="*"

# convert csv to xlsx file, then copy to Dropbox/CSC In-house/Artifact Documents/
echo ''
echo '...converting CSV file to XLSX file, moving to Dropbox'
~/bin/csv_to_xlsx.py

