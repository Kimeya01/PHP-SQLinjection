How to setup
1. create setup.sh file

`sudo nano setup.sh`

2. copy this code into setup.sh file
 
`#!/bin/bash
set -e

sudo apt update
sudo apt install -y apache2 php libapache2-mod-php php-mysql mysql-server phpmyadmin ufw git openssh-server

sudo systemctl enable apache2
sudo systemctl start apache2
sudo systemctl enable mysql
sudo systemctl start mysql
sudo systemctl enable ssh
sudo systemctl start ssh

sudo mysql <<A
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'yourpassword';
FLUSH PRIVILEGES;

CREATE DATABASE IF NOT EXISTS workdb;
USE workdb;
CREATE TABLE IF NOT EXISTS work (
  ID INT(255) PRIMARY KEY,
  username VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  fristname VARCHAR(255),
  lastname VARCHAR(255),
  imagePath VARCHAR(255),
  position VARCHAR(1)
);
INSERT IGNORE INTO work (ID, username, password, fristname, lastname, imagePath, position)
VALUES (1, 'admin', 'pass', 'firstname', 'lastname', 'no', 'a');
A


sudo ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin || true


sudo git clone "https://github.com/Kimeya01/PHP-SQLinjection.git" /var/www/html/ || true
sudo chown -R www-data:www-data /var/www/html/


sudo ufw allow 22
sudo ufw allow 80
sudo ufw --force enable


ip=$(hostname -I | awk '{print $1}')
echo "🌐 Web:  http://$ip/"`


3. Give permissions and run the setup.sh file.

`sudo chmod 777 setup.sh
sudo ./setup.sh`

Enjoy 😁



--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Database Name : workdb

`create table work (ID INT(255),username VARCHAR(255),password VARCHAR(255),fristname VARCHAR(255),lastname VARCHAR(255),imagePath VARCHAR(255),position VARCHAR(1),PRIMARY KEY (ID),UNIQUE(username)); `

`INSERT INTO work (ID, username, password, fristname, lastname, imagePath, position) VALUES ('1', 'admin', 'pass', 'firstname', 'lastname', 'no', 'a'); `
