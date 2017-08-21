#!/bin/bash

# Get the main directory of the script.
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Add files to this list in order for them to be built.
# All files should be on a new line, and do not use a comma
# to separate the items, this isn't PHP.
BUILD_FILES=(
	""
)

# Files listed here will always be uploaded, regardless of changes
# Perfect for files that are normally in your .gitignore
##FORCE_UPLOADS=(
#	""
#)

## STOP EDITING HERE
function message {
	echo "============================================="
	echo "$1"
	echo "============================================="
}