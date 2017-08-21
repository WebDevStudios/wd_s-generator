#!bin/bash

# This script iterates over BUILD_FILES and
# runs the build.sh script for those folders.

. "${WORKSPACE}/jenkins-config.sh"

message "Build from $DIR";

for i in "${BUILD_FILES[@]}"; do :

	# Build the app directories
	message "Executing build for $DIR/$i"
	sh "$DIR/build.sh" "$DIR/$i"

done