#!/bin/bash
export DATABASE='dropcan'
export USER='garbageman'
export PASSWORD='HUDMFr3jR4SmuLer'
export ENV='PROD'

cd core;
hhvm --mode server -vServer.Type=fastcgi -vServer.Port=1337;