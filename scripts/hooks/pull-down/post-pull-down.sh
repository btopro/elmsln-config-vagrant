#!/usr/bin/sh

# disable modules that will absolutely cause issues if there's
# a significant environment change from prod to dev
drush @elmsln dis securepages apc filecache apdqc --y
# cook the go local script
drush @elmsln cook golocal --mlt-email_address=$1 --y
