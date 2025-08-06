How to setup
1. create setup.sh file

`sudo nano setup.sh`

2. copy code inside Copyme.txt into setup.sh file
 
https://github.com/Kimeya01/PHP-SQLinjection/blob/main/Copyme.txt

3. Give permissions and run the setup.sh file.

`sudo chmod 777 setup.sh`

`sudo ./setup.sh`

Enjoy 😁



--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Database Name : workdb

`create table work (ID INT(255),username VARCHAR(255),password VARCHAR(255),fristname VARCHAR(255),lastname VARCHAR(255),imagePath VARCHAR(255),position VARCHAR(1),PRIMARY KEY (ID),UNIQUE(username)); `

`INSERT INTO work (ID, username, password, fristname, lastname, imagePath, position) VALUES ('1', 'admin', 'pass', 'firstname', 'lastname', 'no', 'a'); `
