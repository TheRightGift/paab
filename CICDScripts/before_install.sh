#!/bin/bash

#download, insatll and integrate NGINX, LARAVEL, Composer, MySQL, PHPmyAdmin
#TODO

#creat wcdTest folder if not existing
DIR="/var/www/whitecoatdomain"
if [ -d "$DIR" ]; then
  echo "${DIR} exists"
else
  echo "Creating ${DIR} directory"
  mkdir ${DIR}
fi