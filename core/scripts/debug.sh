#!/bin/bash
export DATABASE='dropcan'
export USER='garbageman'
export PASSWORD='password'
export ENV='DEV'

cd core;
hhvm --mode server -vServer.Type=fastcgi -vServer.Port=1337;