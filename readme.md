# Archive system App

This is an archive system app with multiple user support.

This is built on Laravel Framework 5.8.

This application is converting up to 90% percent of paper to electronic documents.

## Installation

Clone the repository-
```
git clone https://github.com/Ahmed-Mansour-Hallaba/archive-system.git
```

Then cd into the folder with this command-
```
cd archive-system
```

Then do a composer install
```
composer install
```

Then create a environment file using this command-
```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_USERNAME`, `DB_PASSWORD`).

Then run script `tarchives.sql` 

Then change permission of storage folder using thins command-
```
(sudo) chmod 777 -R storage
```

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

## Run server

Run server using this command-
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.

## Login with admin account
```
UserName: admin@123
Password: 123456
```

## Ask a question?

If you have any query please contact at am00767@gmail.com
