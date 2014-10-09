-- Doesn't really matter, but no pass seems so wrong
grant all on *.* to garbageman@'%' identified by 'HUDMFr3jR4SmuLer' with grant option; 
flush privileges;

DROP USER root@'%';

ALTER TABLE `dropcan` ADD hash VARCHAR(60);
UPDATE `dropcan` SET hash = md5(memo);

ALTER TABLE `dropcan` ADD tweeted bool;
UPDATE `dropcan` SET tweeted = 0;