select @status := `memo`, @hash := `hash` from dropcan where settings = 'memo' and time >= UNIX_TIMESTAMP() - 3600 and tweeted = 0 order by hash desc limit 1;
update dropcan set tweeted = 1 where hash = @hash;
select @status;