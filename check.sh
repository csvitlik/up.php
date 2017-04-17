#!/bin/sh

set -o errexit
set -o nounset

upload_dir="`pwd`/h/"
if [ ! "x$1" = "x" ]
then
    upload_dir="$1"
fi
# 24*24*3600
mmin=2073600
rm='rm -f'
find=/usr/bin/find

$find $upload_dir -mmin +$mmin -exec $rm {} \;
