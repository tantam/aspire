#Installation

Before install this project, you will need to make sure your server meets the following requirements:

* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension


## Step 1:
First you need to clone project buy this command

`git clone git@github.com:tantam/aspire.git`

After that you go inside project folder by

`cd aspire`

## Step 2:
And run this command to install all necessary packages and libraries

`composer install`

When composer install is done, there is a .env file will be created in root folder, you need to edit database configuration in order to make application run 

## Step 3:
Creating migration tables
`php artisan migrate:install`

We need to run migration to create new tables. Because we use a module package, so we need to use these command below

```
php artisan module:migrate User
php artisan module:migrate Loan
```

 After all installation and migration are done, now you can use application


# Features
- Create new user
- Update a user by ID
- Get user list
- Create a loan with user id
- Get list loan of a user
- Get load detail by loan id and user id
- Pay repayment buy user id, loan id and repayment id
