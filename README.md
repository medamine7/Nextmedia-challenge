# Nextmedia-challenge
To run the project follow the instructions below (the database is built on MongoDB):

1 - pull the project to your machine

2 - navigate to the project then run composer install

3 - run npm install

4 - run php artisan key:generate

5 - run php artisan migrate, no need to to modify the .env file, just use the one that comes with the repository

6 - download the dump file at https://drive.google.com/open?id=16HsEKUFh1c3ToqITYvmZxZVbQXvQQpFZ
unzip it then run the following command : mongorestore --db nextmedia path/to/file/dump/nextmedia/

(don't use the dump file that comes with challenge, use the one in the link above since changes have been made to the database)

7 - run php artisan serve

8 - the project should be running fine now. In case of issues, you're welcome to contact me.



