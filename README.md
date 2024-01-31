# JSU Internet Engineering Project (Tourism)
## Installing
SQL file for database is provided inside the root directory. Import `ie-project.sql` file before running project.
then edit your database connection info inside `app/Kernel/DB.php`.

## Running project
At first, make sure you have added php executable in your OS path setting by running command:
```shell
php -v
```
Then easily run `run.bat` file to serve project on windows, or:
```shell
php -S 127.0.0.1:8000 -t public
```
for other operating systems.
### Alternative way
Run command:
```shell
"path/to/php/executable" -S 127.0.0.1:8000 -t public
```

## Notes
Just in case of using nginx, `.htaccess` file is also added to redirect all requests from `public` directory in to `public/index.php` file.
