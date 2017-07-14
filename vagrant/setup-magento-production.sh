#!/usr/bin/env bash

dbuser='root'
dbpass='[db_pass]'
dbname='magento'
dbhost='127.0.0.1'
magento_base_url='[your_vm_host_name]'
magento_admin_first_name='Admin'
magento_admin_last_name='Magento'
magento_admin_pass='admin123'
magento_admin_user='admin'
magento_admin_email='email@change.me'
magento_backend_frontname='admin'
magento_lang='en_US'
magento_currency='SGD'
magento_timezone='Asia/Singapore'
root_dir='[your_home_directory]'

sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get -y install git-all

sudo apt-get -y install zip unzip
sudo apt-get -y remove php7.1
sudo apt-get -y remove php7.1-cli
sudo apt-get -y install php5.6 php5.6-cli php5.6-mbstring php5.6-dev php5.6-curl php5.6-imagick php5.6-gd php5.6-mcrypt php5.6-mysql php5.6-xdebug php5.6-intl php5.6-xsl php5.6-zip
echo "xdebug.max_nesting_level=200" >> /etc/php/5.6/apache2/php.ini
sudo apt-get -y install phpunit
php -i
php -v
php -m
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password [db_pass]'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password [db_pass]'
sudo apt-get -y install mysql-server-5.6
sudo service mysql restart
sudo update-rc.d mysql defaults
sudo apt-get -y install apache2
sudo update-rc.d apache2 defaults
sudo service apache2 start
sudo a2enmod rewrite
sudo cp apache2.conf /etc/apache2/apache2.conf
sudo service apache2 stop

sudo rm -f /var/www/html/index.html
sudo chmod -R 777 /var/www/html

echo 'install composer'

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer clearcache
[ -d $root_dir/.composer ] || mkdir $root_dir/.composer
echo '{"http-basic": {"repo.magento.com": {"username": "[magento_public_key]","password": "[magento_private_key]"}}, "github-oauth": {"github.com": "[github_oauth]"}}' > $root_dir/.composer/auth.json

echo 'create magento project'
composer create-project --ignore-platform-reqs --repository-url=https://repo.magento.com/ magento/project-community-edition /var/www/html/
sudo mysql --user=$dbuser --password=$dbpass -e "CREATE DATABASE magento;"
php -m
php -v
php -i

echo 'install magento'
sudo php /var/www/html/bin/magento setup:install --base-url=$magento_base_url --db-host=$dbhost --db-user=$dbuser --db-password=$dbpass --db-name=$dbname --admin-firstname=$magento_admin_first_name --admin-lastname=$magento_admin_first_name --admin-email=$magento_admin_email --admin-user=$magento_admin_user --admin-password=$magento_admin_pass --backend-frontname=$magento_backend_frontname --language=$magento_lang --currency=$magento_currency --timezone=$magento_timezone
sudo php /var/www/html/bin/magento deploy:mode:set production
sudo php /var/www/html/bin/magento cache:disable
sudo php /var/www/html/bin/magento cache:flush
sudo php /var/www/html/bin/magento setup:performance:generate-fixtures /var/www/html/setup/performance-toolkit/profiles/ce/small.xml
sudo chmod -R 777 /var/www/html
sudo service apache2 start
