# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box             = "dropcanco"
  config.vm.box_url         = "http://ugtim.es/ug-devbox"
  config.ssh.forward_agent  = true

  if Vagrant::Util::Platform.windows?
  	# Potentially configure for smb/rsync no luck on windows (DM)
    config.vm.synced_folder   "./", "/home/vagrant/"
  else
    config.vm.synced_folder   "./", "/home/vagrant/", nfs: true
  end
  
  config.vm.network :private_network, ip: "10.10.10.10"

end