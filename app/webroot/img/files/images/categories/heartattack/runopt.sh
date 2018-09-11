#!/bin/sh

for i in `ls *.jpg`
do
  echo "Editing $i ..."
 if jpegtran -copy none -optimize -perfect "$i" > zopt.jpg
 then cp zopt.jpg "$i"
 fi 
done
rm zopt.jpg
