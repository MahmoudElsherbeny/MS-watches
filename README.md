## MS Watches Store

MS Watches is an store e-commerce website for watches (website to specific store not multi seller) created using laravel. In MS watches user can search for any watche, there are categories and shop page with filers to help user get what he want. in dashboard we give owner all control to the store, owner can control (categories, products, store slider, store settings, determine admins, ...etc) by CRUD system and can follow products & sells operations. 

Project not finished yet but still working on it.
(MS watches is my first real project, i'm working hard to learn and make it professional)


## Technolgies used

- **[laravel](https://laravel.com/docs)**
- **[livewire](https://livewire.com/docs)**

## Packages downloaded

- **[shopping cart](https://github.com/bumbummen99/LaravelShoppingcart)** for cart
- **[laravel ui](https://github.com/laravel/ui)** for authintication


# Getting started

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation#installation)

After clone the repository, Switch to the repo folder

    cd ms-watches-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeder and you're done

    php artisan db:seed

Run the database storage link for files

    php artisan storage:link

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000 



***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

----------
