Project description:

                    Task management system

-Functionality of adding, extracting and deleting tasks;
 
-Functionality of assigning responsible and deadline tasks;

-Possibility of attaching files and comments to the task;

-Realization of income and statistics on completed tasks.


Installation

1. Clone this repository

2. Create the file `./.docker/.env.nginx.local` using `./.docker/.env.nginx` as template. The value of the variable `NGINX_BACKEND_DOMAIN` is the `server_name` used in NGINX.

3. Go inside folder `./docker` and run `docker-compose up -d` to start containers.

4. Go inside docker container php `docker-compose exec php bash`.

6. Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.

6. Use the following value for the DATABASE_URL environment variable:
```
DATABASE_URL=mysql://app_user:helloworld@db:3306/app_db?serverVersion=8.0.23
```

