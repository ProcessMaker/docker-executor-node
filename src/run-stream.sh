#!/bin/sh
set -e

tar xf - -C /

/bin/sh /opt/executor/run.sh

if [ "$#" -gt 0 ]; then
    tar cf - -C / "$@"
fi
