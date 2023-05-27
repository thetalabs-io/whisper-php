#!/usr/bin/env php
<?php

if (empty($argv[1])) {
    echo "Usage: php whisper.php <path to file>" . PHP_EOL;
    exit(1);
}

require 'src/Whisper/Whisper.php';

use Whisper\Whisper;

$whisper = new Whisper('tiny.en');

$transcript = $whisper->transcribe($argv[1]);

var_dump($transcript);