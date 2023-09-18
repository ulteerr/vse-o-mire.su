<?php

use app\database\faker\UserFaker;
use app\database\faker\ArticleFaker;
use app\database\faker\CommentFaker;
use app\database\faker\RepliesFaker;
use app\database\faker\RoleFaker;

require 'require.php';

RoleFaker::run();
UserFaker::run();
ArticleFaker::run();
CommentFaker::run();
RepliesFaker::run();
