#!/bin/sh

# sql file vars

DBFILE="./db.sql"
TRIGGERFILE="./triggers.sql"
INSERTFILE="./inserts.sql"
CONFIGFILE="/usr/local/include/simpleconsulting.ini"

# db vars

USER=`awk -F"=" '/username/{gsub(/^[ \t]+/, "", $2); print $2}' $CONFIGFILE`
DB=`awk -F"=" '/dbname/{gsub(/^[ \t]+/, "", $2); print $2}' $CONFIGFILE`
HOST=`awk -F"=" '/host/{gsub(/^[ \t]+/, "", $2); print $2}' $CONFIGFILE`

# run the sql commands

psql -U "$USER" -d "$DB" -h "$HOST" -f "$DBFILE" -f "$TRIGGERFILE" -f "$INSERTFILE" -q

# clean exit

exit 0
