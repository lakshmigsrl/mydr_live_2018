# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![License](https://img.shields.io/packagist/l/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run
```bash
composer create-project --prefer-dist cakephp/app [app_name]
```

You should now be able to visit the path to where you installed the app and see
the setup traffic lights.

## Configuration

Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application.


## Ansible
```
ansible-playbook playbook.yml -l mydr_pro -i hosts -u ubuntu
```

### Before you run command
Please add your key to EC2 instances

### Config
* Ansible config
* https://github.com/Cirrushealthcare/mydr.com.au/blob/master/ansible/playbook.yml
* Ansible valuable
* https://github.com/Cirrushealthcare/mydr.com.au/blob/master/ansible/vars/mydr_pro.yml
* Apache
* https://github.com/Cirrushealthcare/mydr.com.au/tree/master/ansible/roles/apache
* PHP
* https://github.com/Cirrushealthcare/mydr.com.au/tree/master/ansible/roles/php






### For Operations

#### Updating assets

Try this first: `cd /var/www/mydr/mydr.com.au/app/webroot && ../bin/cake asset_compress build`.

If it doesn't work, do this:

```
sudo apt-get install openjdk-7-jre-headless
sudo apt-get install yui-compressor
sudo apt-get install -y nodejs
sudo apt-get install -y node-uglify

cd /var/www/mydr/mydr.com.au/app/webroot
nano /var/www/mydr/mydr.com.au/app/vendor/markstory/mini-asset/src/Filter/YuiJs.php
# Change the jar file path to /usr/share/yui-compressor/yui-compressor.jar

sudo ln -s `which node` /usr/local/bin/node
sudo ln -s `which uglifyjs` /usr/local/bin/uglifyjs
sudo npm install -g uglify-js

mkdir cache_css
../bin/cake asset_compress build
```
