#!/bin/sh

# sql file vars

DBFILE="./db.sql"
TRIGGERFILE="./triggers.sql"
INSERTFILE="./inserts.sql"

# db vars

USER=""
DB=""
HOST=""

# run the sql commands

psql -U "$USER" -d "$DB" -h "$HOST" -f "$DBFILE" -f "$TRIGGERFILE" -f "$INSERTFILE" -q

# clean exit

exit 0
