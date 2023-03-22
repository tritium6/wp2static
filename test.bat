@echo off

for /f "delims=" %%# in ('powershell get-date -format "{dd-MMM-yyyy HH:mm:ss}"') do @set _date=%%#
echo %_date%
echo %_date%>>logfile.txt