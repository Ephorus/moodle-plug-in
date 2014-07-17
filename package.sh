#!/bin/bash

VERSION=$1

if [[ -z $VERSION ]]; then
	echo "Please provide a version, choose from these"
	ls release-notes|cut -c 8-|sed -e 's/.txt//'|sed -e 's/^/* /'
	exit 1
fi

RELEASE_NOTES_FILE=release-notes/README-${VERSION}.txt
if [[ ! -f $RELEASE_NOTES_FILE ]]; then
	echo "Invalid release version specified"
	exit 2
fi

# Get/update version of comms
# TODO

# Create working directory
rm -rf build
mkdir -p build/ephorus

# Create zip-file
cp -r \
	db \
	img \
	lang \
	include \
	*.php \
	styles.css \
	build/ephorus
rm -f build/ephorus/include/comms/.git

cp \
	$RELEASE_NOTES_FILE \
	build/ephorus/README.txt

cd build
zip --quiet -r moodle-ephorus-${VERSION}.zip *

