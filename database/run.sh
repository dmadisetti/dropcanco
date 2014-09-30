#!/bin/bash

if [ ! -f /var/lib/mysql/ibdata1 ]; then

	sudo mysql_install_db
	sudo service mysql start > /dev/null 2> /dev/null; # out kills docker 
	echo "create database if not exists dropcan;" | sudo mysql;
	sudo mysql wp < /seed.sql;
	sudo mysql wp < /prod.sql;

    killall mysqld
    sleep 30s		# kill all and wait.

fi

/usr/bin/mysqld_safe