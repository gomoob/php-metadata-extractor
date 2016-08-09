# php-metadata-extractor

> PHP wrapper to easily call the Java metadata-extrator library.

[![Total Downloads](https://img.shields.io/packagist/dt/gomoob/php-metadata-extractor.svg?style=flat)](https://packagist.org/packages/gomoob/php-metadata-extractor) 
[![Latest Stable Version](https://img.shields.io/packagist/v/gomoob/php-metadata-extractor.svg?style=flat)](https://packagist.org/packages/gomoob/php-metadata-extractor) 
[![Build Status](https://img.shields.io/travis/gomoob/php-metadata-extractor.svg?style=flat)](https://travis-ci.org/gomoob/php-metadata-extractor)
[![Coverage](https://img.shields.io/coveralls/gomoob/php-metadata-extractor.svg?style=flat)](https://coveralls.io/r/gomoob/php-metadata-extractor?branch=master)
[![Code Climate](https://img.shields.io/codeclimate/github/gomoob/php-metadata-extractor.svg?style=flat)](https://codeclimate.com/github/gomoob/php-metadata-extractor)
[![License](https://img.shields.io/packagist/l/gomoob/php-metadata-extractor.svg?style=flat)](https://packagist.org/packages/gomoob/php-metadata-extractor)

## Introduction

`php-metadata-extractor` is a wrapper used to call the powerful Java 
[`metadata-extractor`](https://github.com/drewnoakes/metadata-extractor "metadata-extractor") library and have access to
the same APIs in PHP.

So here we'll provide the same documentation as `metadata-extractor` but for PHP, here is how to get metadata 
with the library.

```php
Metadata metadata = ImageMetadataReader.readMetadata(imagePath);
```

## Installation

The easiest way to install the library is to use [composer](https://getcomposer.org/ "composer") and define the 
following dependency inside your `composer.json` file :

```json
{
    "require": {
        "gomoob/php-metadata-extractor": "~2.9"
    }
}
```

Please also note that because the library is a wrapper around a Java library the `java` executable must be available
in your `PATH` variable.

## Versioning

To easier version identification the version of `php-metadata-extractor` will always be aligned with the version
of the Java `metadata-extractor`. 

Stable versions of `php-metadata-extrator` will be equal to `X.Y.Z-N` where `N` represents a patch number 
associated to `php-metadata-extractor`. 

Unstable or uncomplete versions of `php-metadata-extractor` will be equal to `X.Y.Z-alpha.N`,  
`X.Y.Z-beta.N` or `X.Y.Z-rc.N`. 

## Contribute

### Rules

The `metadata-extractor` Java library is very complete, so we need to improve its integration, if you would like 
to contribute please respect the following rules : 

* Create your pull requests only on the `develop` branch, the `master` branch should only be used by Gomoob to 
  create new versions ; 
* Use the `grunt phpcbf` command to automatically format your code with PHP Code Sniffer ; 
* Use the `grunt phpcs` command to check your code before creating your Pull request ; 
* Always try to fully document your classes, properties and functions. 

### Builds

The build scripts are managed with [Grunt]("Grunt"), to use is you first have to install [Node]("Node") and use the 
`npm install`.

The PHP dependencies are managed with [Composer]("Composer"), run the `composer update` command before calling any
build command.

Ensure you have a working Java environnement and that the `java` executable is available in your `PATH`.

The following builds are available :

* `grunt` clean temporary build files, run the PHPUnit unit tests and generated the PHPDocumentor documentation ;
* `grunt phpcbf` automatically clean the source code for PHP Code Sniffer ; 
* `grunt phpcs` check the validity of the source code with PHP Code Sniffer ; 
* `grunt test` execute the PHPUnit unit tests ; 
* `grunt generate-documentation` generate the PHPDocumentor documentation ; 
* `grunt pdepend` generate the PDepend quality charts ; 
* `grunt phpmd` generate the PHPMD code quality reports.

## About Gomoob

At [Gomoob](https://www.gomoob.com "Gomoob") we build high quality software with awesome Open Source frameworks 
everyday. Would you like to start your next project with us? That's great! Give us a call or send us an email and we 
will get back to you as soon as possible !

You can contact us by email at [contact@gomoob.com](mailto:contact@gomoob.com) or by phone number 
[(+33) 6 85 12 81 26](tel:+33685128126) or [(+33) 6 28 35 04 49](tel:+33685128126).
