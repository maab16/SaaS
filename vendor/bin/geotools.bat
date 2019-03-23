@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../league/geotools/bin/geotools
php "%BIN_TARGET%" %*
