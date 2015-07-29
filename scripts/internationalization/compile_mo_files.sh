#!/bin/bash

set -e

ROOT=`dirname $0`"/../../"

cd $ROOT

ROOT=`pwd`

cd src

RESDIR=$ROOT/resources/internationalization

cd $RESDIR/po

for i in *.po ; do
    base=${i/.*/}
    mkdir -p ../mo/${base}/LC_MESSAGES
    rm -f ../mo/${base}/LC_MESSAGES/phabricator.mo
    msgfmt $i -o ../mo/${base}/LC_MESSAGES/phabricator.mo
done

