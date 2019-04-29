<?php

require "libs/rb-mysql.php"
R::setup( 'mysql:host=localhost;dbname=chat','root', '12345');

session_start();