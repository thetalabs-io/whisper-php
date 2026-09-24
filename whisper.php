#!/usr/bin/env php
<?php

/*
 * ARCHIVED — DO NOT USE.
 *
 * This file is kept for historical reference only. transcribe() interpolates
 * its argument into a Python program, so any caller controlling the file path
 * can execute arbitrary code. See README.md for a maintained replacement.
 */

if (empty($argv[1])) {
    echo "Usage: php whisper.php <path to file>" . PHP_EOL;
    exit(1);
}

require 'src/Whisper/Whisper.php';

use Whisper\Whisper;

$whisper = new Whisper('tiny.en');

$transcript = $whisper->transcribe($argv[1]);

var_dump($transcript);