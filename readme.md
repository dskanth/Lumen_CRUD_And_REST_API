## This repository covers the following:

# Products List CRUD with Lumen and Angular JS 1
# Notes REST API with Lumen

Application that demonstrates API REST using Lumen (PHP) and Angular 1.

Original repo: https://github.com/guillermo-maquieira/lumen 

## Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Screenshot


![](https://github.com/dskanth/Lumen_CRUD_AngularJS_Example/blob/master/lumen_angular_crud.JPG)

## Steps to deploy

1. Create a database in your PhpMyAdmin, and import the database.sql file to it
2. Specify the database configuration in the .env file

## Testing the Notes REST API

1. Get all notes: host.com/api/v1/notes
2. Get notes by id: host.com/api/v1/note/{id}
3. Get notes of a user: host.com/api/v1/notes/user/{username}
4. Add a new note: Send a Post request to: host.com/api/v1/note
5. Update a note: Send a PUT request to: host.com/api/v1/note/{id}
6. Delete a note: Send a DELETE request to: host.com/api/v1/note/{id}
