# DATABASES - TEAM 22

### Team Mebmers:

- Christina Kostaki | el18136
- Dimitris Matsis | ge14511
- Giorgos Kaoukis | el19006

### Database Import
To import the Database, open your favorite MariaDB SQL manager (like phpMyAdmin) and import the SQL scripts with the below order:
  - DDL: `schema.sql`
  - Views: `views.sql`
  - DML: `insert.sql`

This will create a DB named `elidek` filled with all the Mock Data needed by the excercise.

### User Interface Hosting
The Frontend application of the DB is written in PHP and hosted with Apache. To host the Frontend application:
  - Find the Apache host directory (for example, `{XAMPP_DIR}\htdocs`)
  - Create a new directory and copy the frontend directory contents in the newly made directory
  - Change the `DocumentRoot` path on the `httpd.conf` file found on XAMPP's configuration text files. The new path should be the newly made directory that was made earlier (for example, `{XAMPP_DIR}\htdocs\elidek`)

Searching `localhost/index.php` on any browser should bring up the Main Page of the ELIDEK application.
