#!/bin/bash

#create wcdTest folder if not existing
DIR="/var/www/whitecoatdomain"
if [ -d "$DIR" ]; then
  echo "${DIR} exists"
else
  echo "Creating ${DIR} directory"
  mkdir ${DIR}
fi