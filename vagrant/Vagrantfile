# -*- mode: ruby -*# vi: set ft=ruby :
require 'yaml'
vagrantConfig = YAML.load_file 'Vagrantfile.config.yml'
Vagrant.configure(2) do |config|
  config.vm.box = "bento/ubuntu-14.04"
  config.vm.network "private_network", ip: vagrantConfig['ip']

  # Mount local "~/git/magento-dev/" path into box's "/magento-dev/" path
  config.vm.synced_folder vagrantConfig['synced_folder']['host_path'], vagrantConfig['synced_folder']['guest_path'], owner:"vagrant", group: "www-data"

  # VirtualBox specific settings
  config.vm.provider "virtualbox" do |vb|
  vb.gui = false
  vb.memory = "2048"
  vb.cpus = 2
  end

  # provisioning os
  config.vm.provision "file", source: "~/.gitconfig", destination: ".gitconfig"
  config.vm.provision "shell", inline: "sudo add-apt-repository ppa:ondrej/php"
  config.vm.provision "shell", inline: "sudo apt-get update"
  config.vm.provision "shell", inline: "sudo apt-get -y install git-all"
  # provisioning php
  config.vm.provision "shell", inline: "sudo apt-get -y install zip unzip"
  config.vm.provision "shell", inline: "sudo apt-get -y remove php7.1"
  config.vm.provision "shell", inline: "sudo apt-get -y remove php7.1-cli"
  config.vm.provision "shell", inline: "sudo apt-get -y install php5.6 php5.6-cli php5.6-mbstring php5.6-dev php5.6-curl php5.6-imagick php5.6-gd php5.6-mcrypt php5.6-mysql php5.6-xdebug php5.6-intl php5.6-xsl php5.6-zip"
  config.vm.provision "shell", inline: "echo \"xdebug.max_nesting_level=200\" >> /etc/php/5.6/apache2/php.ini"
  config.vm.provision "shell", inline: "sudo apt-get -y install phpunit"
  # provisioning mysql
  config.vm.provision "shell", inline: "sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password #{vagrantConfig['mysql']['password']}'"
  config.vm.provision "shell", inline: "sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password #{vagrantConfig['mysql']['password']}'"
  config.vm.provision "shell", inline: "sudo apt-get -y install mysql-server-5.6"
  config.vm.provision "shell", inline: "sudo service mysql restart"
  config.vm.provision "shell", inline: "sudo update-rc.d mysql defaults"
  # provisioning apache
  config.vm.provision "shell", inline: "sudo apt-get -y install apache2"
  config.vm.provision "shell", inline: "sudo update-rc.d apache2 defaults"
  config.vm.provision "shell", inline: "sudo service apache2 start"
  config.vm.provision "shell", inline: "sudo a2enmod rewrite"
  config.vm.provision "shell", inline: "sudo awk '/<Directory \\/>/,/AllowOverride None/{sub(\"None\", \"All\",$0)}{print}' /etc/apache2/apache2.conf > /tmp/tmp.apache2.conf"
  config.vm.provision "shell", inline: "sudo mv /tmp/tmp.apache2.conf /etc/apache2/apache2.conf"
  config.vm.provision "shell", inline: "sudo awk '/<Directory \\/var\\/www\\/>/,/AllowOverride None/{sub(\"None\", \"All\",$0)}{print}' /etc/apache2/apache2.conf > /tmp/tmp.apache2.conf"
  config.vm.provision "shell", inline: "sudo mv /tmp/tmp.apache2.conf /etc/apache2/apache2.conf"
  config.vm.provision "shell", inline: "sudo service apache2 stop"
  # provisioning magento installation
  config.vm.provision "shell", inline: "sudo rm -Rf /var/www/html"
  # note that the following line is for development only, for security in production env, u should not set permission to 777
  config.vm.provision "shell", inline: "sudo chmod -R 777 #{vagrantConfig['synced_folder']['guest_path']}"
  config.vm.provision "shell", inline: "sudo ln -s #{vagrantConfig['synced_folder']['guest_path']} /var/www/html"
  config.vm.provision "shell", inline: "curl -sS https://getcomposer.org/installer | php"
  config.vm.provision "shell", inline: "mv composer.phar /usr/local/bin/composer"
  config.vm.provision "shell", inline: "composer clearcache"
  config.vm.provision "shell", inline: "[ -d /root/.composer ] || mkdir /root/.composer"
  config.vm.provision "shell", inline: "echo '{\"http-basic\": {\"repo.magento.com\": {\"username\": \"#{vagrantConfig ['http_basic']['repo_magento_com']['username']}\",\"password\": \"#{vagrantConfig['http_basic']['repo_magento_com']['password']} \"}}, \"github-oauth\": {\"github.com\": \"#{vagrantConfig['github_oauth']['github_com']}\"}}' > /root/.composer/auth.json"
  config.vm.provision "shell", inline: "composer create-project --ignore-platform-reqs --repository-url=https://repo.magento.com/ magento/project-community-edition /var/www/html/"
  config.vm.provision "shell", inline: "sudo mysql --user=#{vagrantConfig['mysql']['username']} --password=#{vagrantConfig['mysql']['password']} -e \"CREATE DATABASE #{vagrantConfig['magento']['db_name']};\""
  config.vm.provision "shell", inline: "sudo php /var/www/html/bin/magento setup:install --base-url=\"#{vagrantConfig['magento']['base_url']}\" --db-host=\"#{vagrantConfig['mysql']['host']}\" --db-user=\"#{vagrantConfig['mysql']['username']}\" --db-password=\"#{vagrantConfig['mysql']['password']}\" --db-name=\"#{vagrantConfig['magento']['db_name']}\" --admin-firstname=\"#{vagrantConfig['magento']['admin_firstname']}\" --admin-lastname=\"#{vagrantConfig['magento']['admin_lastname']}\" --admin-email=\"#{vagrantConfig['magento']['admin_email']}\" --admin-user=\"#{vagrantConfig['magento']['admin_user']}\" --admin-password=\"#{vagrantConfig['magento']['admin_password']}\" --backend-frontname=\"#{vagrantConfig['magento']['backend_frontname']}\" --language=\"#{vagrantConfig['magento']['language']}\" --currency=\"#{vagrantConfig['magento']['currency']}\" --timezone=\"#{vagrantConfig['magento']['timezone']}\""
  config.vm.provision "shell", inline: "sudo php /var/www/html/bin/magento deploy:mode:set developer"
  config.vm.provision "shell", inline: "sudo php /var/www/html/bin/magento cache:disable"
  config.vm.provision "shell", inline: "sudo php /var/www/html/bin/magento cache:flush"
  config.vm.provision "shell", inline: "sudo php /var/www/html/bin/magento setup:performance:generate-fixtures /var/www/html/setup/performance-toolkit/profiles/ce/small.xml"
  # note that the following line is for development only, for security in production env, u should not set permission to 777
  config.vm.provision "shell", inline: "sudo chmod -R 777 /var/www/html"
  config.vm.provision "shell", inline: "sudo service apache2 start"
end
