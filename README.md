# Modularize
This package makes it easy to build API project

## Postcardware
You're free to use this package (it's MIT-licensed), but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
- Author: Fight Light Diamond <i.am.m.cuong@gmail.com>
- MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825

## Requires
- Laravel 5.x or Lumen 5.x

## Install
You can install the package via composer:
`composer require cuongpm/Modularize`

## Usage
The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:

```
'providers' => [
    // ...
    Modularize\ModularizeServiceProvider::class,
];
```

You can publish the migration with:
```angular2html
php artisan vendor:publish
```

### Build base project: 
- User interface
 ```angular2html
{domain}/module/create
 ```
- Use command line
 ```angular2html
 php artisan module:project {table?} {--namespace=App}  {--path=app}  {--seed=no}'
 ```
### Run unit test
 ```angular2html
./vendor/bin/phpunit {pathFolderModule}

./vendor/bin/phpunit --filter {function}  {pathFolderModule}
```
 ##
