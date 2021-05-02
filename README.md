# Json Api

## BOOTSTRAPPING
The project is dockerized. For ease of use, a makefile has been created with different commands.

To start the project for the first time:

`make build`

`make start`

To enter the container we will use

`make ssh-be`

And there we will use `composer install` to install dependencies

You can create your own `.env` file
`.env.example` is a good template for this.

For help to use, `art` is an alias of `php artisan`
<hr>

## USE
You can see url and parameters in the documentation:

https://documenter.getpostman.com/view/5719432/TzRLmqve
<hr>

## FILES
The files used for this exercise are in the 'src/' folder
except the Controlers, Resources, Models and Routes that is used as the entry point to the application and Laravel's own routes file located in 'routes/api.php'
<hr>

## TESTS
todo...
<hr>
