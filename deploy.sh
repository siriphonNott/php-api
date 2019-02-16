#!/bin/sh
# lftp -c "open -u $FTP_USER,$FTP_PASSWORD $FTP_SERVER; set ssl:verify-certificate no; mirror -R ${HOME}/clone/ /projects/app01"
docker-compose up --build -d