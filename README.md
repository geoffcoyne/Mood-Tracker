# Mood-Tracker
This was a project I made so that I could track my mood throughout 2023. It's a website that uses PHP and a PostgreSQL database. It allows you to select between 4 different moods for each day which is then stored in the database as a value between 0 and 3, with 3 being the highest mood. It also allows you to view the data in a table and download it as a CSV.

**IT SHOULD BE NOTED THAT THIS APPLICATION DOES NOTHING TO SECURE YOUR DATA. THE DATA IS NOT HASHED AND THERE IS NO PASSWORD REQURIRED TO ENTER OR VIEW DATA ON THE SITE.**

**IF YOU ARE NOT COMFORTABLE WITH PEOPLE HAVING A GENERAL IDEA OF YOUR MOOD, DAY TO DAY, THIS IS PROBABLY NOT A GOOD SOLUTION FOR YOU.**

## Installation
### Instructions for Ubuntu (and other Debian distros... *I think*)
To set up this website for yourself you'll need a server with Apache, PHP, php-pgsql, and PostgreSQL. 

*Note: if these commands are being run as a user other than root they will likely have to be run using sudo*
#### Setting up Apache
1. To install Apache, PHP, and PostgreSQL: `apt install apache2 postgresql php php-pgsql`
2. Next enable/start PostgreSQL and Apache by running `systemctl enable apache2 && systemctl start apache2` and `systemctl enable postgresql && systemctl start postgresql`
3. Next run `cd /var/www/html` to change directory into the Apache server's root directory. 
4. Then run `rm -R ./*` to remove the default index.html file
5. Clone the git repository using `git clone https://github.com/geoffcoyne/Mood-Tracker/` *Note: you may have to install git using `apt install git`*
6. Move the files out of the cloned repository and delete the repository using `mv ./Mood-Tracker/* ./ && rm -R ./Mood-Tracker`
8. Use a text editor to edit `moodtrackerconf.ini` change username and password to ones of your choice. These will be used when setting up Postgres.
9. Now run `mv moodtrackerconf.ini /etc` to move the .ini file to etc so it cannot be accessed by the client 
10. If you want to be able to download a CSV from the website run `mkdir CSVs` and `chmod 777 CSVs`
11. Next run `cd /etc/apache2`
12. Next run `ls mods-enabled` if *php8.1.conf and php8.1.load* aren't listed run `a2enmod php8.1` and then run `sudo sytemctl restart apache2`

#### Setting up PostgreSQL
1. Start by changing users to the user postgres using the command `sudo -i -u postgres`
2. Enter the PostgreSQL prompt using the command `psql` 
3. Next run `CREATE DATABASE mooddatabase` to create a database for the application to use
4. Now run `\c mooddatabase` to connect to the database
5. Next to create the table to hold your mood data run `CREATE TABLE mood  (id SERIAL, mood SMALLINT, date DATE);`
6. Next create a user for PHP to use to alter data on the database by running `CREATE USER your_username WITH PASSWORD 'your_password;'` *Note: The username and password should be the same as what you put in the .ini file*
7. Now grant your user permission to select, instert, and update your table by running `GRANT SELECT, INSERT, UPDATE ON mood TO your_username`
7. You can now exit your database using `\q` and exit the postgres user by running `exit`

#### Viewing the your website
Your website should not be live at localhost or whatever your public IP address is! 

![hompage](https://user-images.githubusercontent.com/9003050/212434891-b5564491-1de5-4758-953f-b2f81fb0a449.png)

![table](https://user-images.githubusercontent.com/9003050/212434892-e95db4d8-166c-4f9f-a7fd-566533418756.png)

