#!/bin/bash

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php ./composer-setup.php
php -r "unlink('composer-setup.php');"
php -r "eval('?>'.file_get_contents('http://getcomposer.org/installer'));"