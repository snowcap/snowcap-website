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

All credentials has to be defined in your virtualhost configuration, like this:


    SetEnv framework_secret somesecretvalue

    SetEnv database_host your_host
    SetEnv database_name your_db_name
    SetEnv database_user your_user
    SetEnv database_password your_passwrd

    SetEnv mailer_transport smtp
    SetEnv mailer_host your_host
    SetEnv mailer_user your_user
    SetEnv mailer_password your_password

If you want to change the path for the administration part, add the following:

    SetEnv admin_path some_path


Look at the Symfony2 documentation for more information about handling cache refreshing, database updates ...

Enjoy!
