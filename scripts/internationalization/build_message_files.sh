#!/bin/sh

set -e

ROOT=`dirname $0`"/../../"

cd $ROOT

ROOT=`pwd`

cd src

RESDIR=$ROOT/resources/internationalization

filelist=$RESDIR/filelist

find . -name "*.php" | sort > $filelist

for i in $RESDIR/po/*.po ; do
    xgettext --no-location --from-code=utf-8 -L php -k -kpht -j -f $filelist -o $i
    xgettext --from-code=utf-8 -L php -k -kpht -j -f $filelist -o $i
done

