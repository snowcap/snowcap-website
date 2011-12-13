Snowcap public website
========================

What's inside?
--------------

Snowcap website has been built with Symfony2, and contains the exact, up-to-date, unmodified code we use for our website www.snowcap.be
Well, it will when we'll put it in production :)

Installation from Git
---------------------

Run the following commands:

    git clone http://github.com/snowcap/snowcap-website.git


Configuration
-------------

### Configure your personnal stuff
Copy the app/config/parameters.ini.dist to app/config/parameters.ini & fill the gaps

### Load the vendors

    ./bin/vendors install

### Create your database by running some command lines

    ./app/console doctrine:schema:create
    ./app/console doctrine:schema:update --force

### Load some content fixtures

    ./app/console doctrine:fixtures:load

### Troubleshooting & more info

Look at the [Symfony2 documentation](http://symfony.com/doc/current/) if you run into trouble with the above commands

### Enjoy!