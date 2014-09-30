grant all on *.* to garbageman@'%' identified by 'password' with grant option; 
flush privileges;

ALTER TABLE `dropcan` ADD hash VARCHAR(60);
UPDATE `dropcan` SET hash = md5(memo);