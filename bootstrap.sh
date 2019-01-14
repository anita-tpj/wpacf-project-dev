#!/usr/bin/env bash

# Apache 2.4
sudo add-apt-repository ppa:ondrej/apache2 -y
sudo apt-get update
sudo apt-get install apache2 -y

# PHP 5.6
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -y update
sudo apt-get -y install php5.6 php5.6-dev php5.6-mbstring php5.6-mcrypt php5.6-mysql php5.6-xml php5.6-cli php-pear nfs-common
sudo php5.6-mcrypt mcrypt
sudo pecl channel-update pecl.php.net
sudo pecl install xdebug

# Install Mysql and set root password on root user
export DEBIAN_FRONTEND=noninteractive
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get -q -y install mysql-server-5.5

# Install phpmyadmin and set all 'prompt settings' predefined
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

# Install wp-cli
curl -L https://raw.github.com/wp-cli/builds/gh-pages/phar/wp-cli.phar > wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/bin/wp

VHOST=$(cat <<EOF
<VirtualHost *:80>
    DocumentRoot "/vagrant"
    ServerName localhost
    <Directory "/vagrant">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF
)

echo "$VHOST" > /etc/apache2/sites-enabled/000-default.conf

# Create database and user
mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS wp"
mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON wp.* TO 'wpuser'@'localhost' IDENTIFIED BY 'wppassword'"
mysql -uroot -proot -e "FLUSH PRIVILEGES"

sudo su

# Add phpmyadmin options inside apache
echo "Include /etc/phpmyadmin/apache.conf" >> /etc/apache2/apache2.conf

# Add Xdebug settings at the end of php.ini
cat <<EOT >> /etc/php/5.6/apache2/php.ini
[xdebug]
zend_extension=/usr/lib/php/20131226/xdebug.so
xdebug.remote_enable=1
xdebug.remote_host=10.0.2.2
xdebug.remote_port=9000
EOT

sudo a2enmod rewrite

sudo service apache2 restart