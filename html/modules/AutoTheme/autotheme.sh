#!/bin/sh

clear

echo "Setting permissions for AutoTheme..."
echo ""
echo "Making compile directory writable..."
chmod a+rwx ./_compile
echo "Making autotheme.cfg file writable..."
chmod a+rw ./autotheme.cfg
echo "Making themes directory writable..."
chmod a+rwx ../../themes/
echo "Making individual theme.cfg files writable..."
find ../../themes/ -type f -name '*.cfg' -exec chmod a+rw {} \;
echo ""
echo "Done!"
echo ""