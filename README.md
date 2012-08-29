# Zend 2.0 integrated with Doctrine 2.3


## Introduction

This is a simple "Hello world" application using Zend framework 2.0 
integrated with ORM Doctrine 2.3. There are implemented 4 basic 
operations (CRUD) about one entity User.  

## Requirements

- [Zend Framework 2](http://www.github.com/zendframework/zf2)
- [Doctrine](https://github.com/tomaskocfelda/Doctrine)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)

## Installation

#### 1. Downloading source codes with GIT (recommended)

Clone repository to your local machine:

    git clone --recursive https://github.com/tomaskocfelda/Zend2-Doctrine2.git

This will download the core project with all libraries needed.


#### 1. ... or downloading source codes with SVN

Checkout project https://github.com/tomaskocfelda/Zend2-Doctrine2.git to your local machine. 
Then checkout separately libs to precreated dirs in /vendors:

- zf2 - http://www.github.com/tomaskocfelda/zf2
- Doctrine - https://github.com/tomaskocfelda/Doctrine
- DoctrineModule - https://github.com/doctrine/DoctrineModule
- DoctrineORMModule - https://github.com/doctrine/DoctrineORMModule

#### 2. Creating database

Run SQL create script /data/db/create-script.sql


#### 3. Setting virtual host

Set up a virtual host to point to the public/ directory.

#### 4. Running application

Now application is ready to go.