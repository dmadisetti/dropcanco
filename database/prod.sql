-- Doesn't really matter, but no pass seems so wrong
grant all on *.* to garbageman@'%' identified by 'HUDMFr3jR4SmuLer' with grant option; 
flush privileges;

DROP USER root@'%';