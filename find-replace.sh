#!/bin/sh
                          
for file in $(grep -il "./content" *.txt)
do
sed -e "s/beta\.curatorialprojects\.brooklynrail.org/curatorialprojects\.brooklynrail\.org/ig" $file > /tmp/tempfile.tmp
#mv /tmp/tempfile.tmp $file
done
