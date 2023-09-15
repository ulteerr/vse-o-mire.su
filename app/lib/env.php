<?php

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(base_path(), '.env');
$dotenv->load();