# cmdatamodules-2.0
Make CM Datamodules great again!

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d195afd1217f46b0980ebf7b2e886074)](https://www.codacy.com?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=huib0029/cmdatamodules-2.0&amp;utm_campaign=Badge_Grade)

## Beginnen (installatie):

```
composer install
```
```
cp .env.example .env
```
.env bestand aanpassen
```
php artisan migrate
```
```
php artisan key:generate
```
Enjoy!

### Prerequisites

Voor de publieke data API is een Extensie Allow-Control-Allow-Origin: * nodig zoals CORS

```
Pas in het .env bestand het Google ID en Google client aan voor OpenIDconnect met Google
```
## Tests:

Gebruik hiervoor PHPunit in de rootfolder
```
Voor PHPstorm:  phpunit.phar (phpunit library), phpunit.xml (default configuration file), \tests (default test folder) en PHP7 CLI
```

### Codestyling

Gebruik je eigen codestyling library (styleci, codacy etc.)

## Deployment:

Gebruik hiervoor npm production (public, production) of npm dev (development) in de rootfolder

## Continuous integration\deployment:

Gebruik hiervoor bijvoorbeeld TravisCI of CircleCI (zie .env.circleci voor de configuratie)

## Usage:

- OpenIDConnect:
Laravel:
View: auth\openidconnect.blade.php 
Controller: controllers\Controller.php 

- API publieke data:
Laravel: 
view: api.blade.php 
Angular: 
resources\assets\js\ app.js en APIControllerAngular.js en APIServiceAngular.js

- Tasks crud:
Laravel: 
View: angular.blade.php
Controller: TaskController.php (validatie, een taak maken in database)
Model: Task.php
Angular:
Controller: resources\assets\js\ app.js en TaskControllerAngular.js

- Laravel Scout (projecten pagina):
Laravel: 
View: angular.blade.php
Controller: ProjectsController.php
Model: Project.php
Seed: ProjectsTableSeeder
Route API: routes\api.php
Angular:
Controller: resources\assets\js SearchcontrollerAngular.js 

- Tests:
Diverse Feature en Unit tests



