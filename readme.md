## Installation

Installation requires following a few simple steps:

- Clone this repository
- On the command line, in the directory you cloned this repository to, run the following commands:
- run `composer install` (you need composer installed, test by typing `composer -V`)
- run `sudo npm install -g yarn`
- run `yarn` (you need node and npm installed, test by typing `npm -v`)
- run `cp .env.example .env`
- run `php artisan key:generate`
- Next up you need to create an empty mysql database for this site.
- Then, open the project in your code editor of choice and edit the `.env` file, and change the following to match your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=changeme
DB_USERNAME=changeme
DB_PASSWORD=changeme
```

- Your `.env` needs the following properties added to it:

```
BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=database
QUEUE_DRIVER=database
MAIL_DRIVER=mail
```

- **Back on the command line**, you need to run two more commands
- run `php artisan migrate` (This installs the database schema for you)
- run `php artisan db:seed` (This seeds the database schema for you)
- run `php artisan storage:link` (Does magic for non valet setups)
- run `npm run watch` (This compiles the SCSS and JS for you, like gulp used to)
- Visit the site in your browser.

## License

[![Creative Commons Licence](https://i.creativecommons.org/l/by-sa/4.0/88x31.png)](http://creativecommons.org/licenses/by-sa/4.0/)  

The Online Publishing System (OPS) is copyright 2017 Michael Burton. This work is licensed under a [Creative Commons Attribution-ShareAlike 4.0 International License](http://creativecommons.org/licenses/by-sa/4.0/). 

Additions are welcomed, as long as they are shared with the original author, and this attribution remains to the author of the software.
