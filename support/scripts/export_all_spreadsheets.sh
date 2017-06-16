#!/bin/bash
# define 4 types of spreadsheets
array=( 'accounting' 'dennis' 'exdev' 'restoration_conservation' )

# backup mySQL database
echo ''
echo '...backing up mySQL database for CollectiveAccess'
cd ~/backup
today=`date '+%Y_%m_%d__%H_%M_%S'`
today_short=`date '+%Y_%m_%d'`
mysqldump -u causer -pdreU6yGKIE6VCspPv6un collectiveaccess > ~/backup/${today}__collectiveaccess.sql

for sheet_type in ${array[@]}
do
    # # copy mapping file from Dropbox into server
    # echo ''
    # echo '...copying' $sheet_type 'mapping files from Dropbox into server'
    # cp ~/Dropbox/${sheet_type}_spreadsheet_mapping.xlsx /var/www/html/support/export_spreadsheets/mappings

    # # change permissions
    # echo ''
    # echo '...changing permissions of' $sheet_type 'mapping'
    # cd /var/www/html/support/export_spreadsheets
    # sudo chgrp www-data mappings/${sheet_type}_spreadsheet_mapping.xlsx
    # sudo chmod 750 mappings/${sheet_type}_spreadsheet_mapping.xlsx

    # load export mappings
    echo ''
    echo '...loading' $sheet_type 'export mapping in CollectiveAccess'
    cd /var/www/html/support
    ./bin/caUtils load-export-mapping --file=export_spreadsheets/mappings/${sheet_type}_spreadsheet_mapping.xlsx

    # export data
    echo ''
    echo '...exporting' $sheet_type 'data from CollectiveAccess to CSV files'
    cd /var/www/html/support
    ./bin/caUtils export-data --file=export_spreadsheets/data/${sheet_type}/${today_short}__Artifact_Donation_and_Acquisitions__${sheet_type}.csv --mapping=export_${sheet_type}_spreadsheet --log=export_spreadsheets/log --search="*"

    # # copy exported data from server into Dropbox
    # echo ''
    # echo '...copying' $sheet_type 'data from server into Dropbox'
    # cp /var/www/html/support/export_spreadsheets/data/${sheet_type}/${today_short}__Artifact_Donation_and_Acquisitions__${sheet_type}.csv ~/Dropbox
done

# convert all CSV files to XLSX, then copy all to Dropbox/CSC In-house/Artifact Documents/
echo ''
echo '...converting all CSV files to XLSX files, moving to Dropbox'
# ~/Dropbox/csv_to_xlsx_all.py
/var/www/html/support/scripts/csv_to_xlsx_all.py
