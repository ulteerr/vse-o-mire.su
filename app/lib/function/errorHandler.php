<?php

use app\lib\common\Log;

function errorHandler($errno, $errstr, $errfile, $errline)
{
	Log::channel('default')->error("[$errno] $errstr in $errfile on line $errline");
}
