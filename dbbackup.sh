#!/bin/sh

Mdate="$(date +"%Y-%m-%d-%H:%S")"
mysqldump -uroot -pRoller12# webmenu > /home/webmenu/projects/menu/DBbackups/$Mdate.sql
cd /home/webmenu/projects/menu/
git add .
git commit -a -m "DB backup $Mdate"
git push
