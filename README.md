# Book Inventory System

## Project Description

The project is a book inventory system built with [Laravel 8](https://laravel.com). The features of this project include

1. Registration and Authentication of users.
2. Creation and Uploading of Books.
3. Editing and Update of uploaded books.
4. Archival and Restoration of archived books.
5. Permanent Deletion of books.

## Project Setup(Web Portal)

### Cloning the GitHub Repository.

Clone the repository to your local machine by running the terminal command below.

```bash
git clone https://github.com/Ojsholly/book-inventory
```

### Setup Database

Create your a MySQL database and note down the required connection parameters. (DB Host, Username, Password, Username)

### Install Composer Dependencies

Navigate to the project root directory via terminal and run the following command.

```bash
composer install
```

### Install NPM Dependencies

While still in the project root directory via terminal, run the following command.

```bash
npm install && npm run dev
```


### Create a copy of your .env file

Run the following command

```bash
cp .env.example .env
```

This should create an exact copy of the .env.example file. Name the newly created file .env and update it with your local environment variables (database connection info and others).

### Generate an app encryption key

```bash
php artisan key:generate
```

### Migrate the database

```bash
php artisan migrate
```

### Create the Storage Symlink

```bash
php artisan storage:link
```
### License

[MIT](https://choosealicense.com/licenses/mit/)
