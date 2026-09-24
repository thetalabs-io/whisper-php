# whisper-php

> [!WARNING]
> **This project is archived and was never released.** It is kept for historical
> reference only. Do not use this code — see [Security](#security) below.

An abandoned 2023 experiment in wrapping [OpenAI Whisper](https://github.com/openai/whisper)
from PHP by shelling out to a Python interpreter. It never reached a working
state, was never published to Packagist, and has no users.

## Use this instead

PHP no longer needs a Python sidecar to run Whisper locally. The recommended
replacement is **[displace/ext-whisper](https://github.com/DisplaceTech/ext-whisper)**,
a native PHP 8.3+ extension that runs whisper.cpp in-process:

```bash
composer require displace/ext-whisper
```

```php
use Displace\Whisper\Model;

$model  = Model::load('models/ggml-tiny.en.bin');
$result = $model->transcribe('audio/meeting.wav');

echo $result->text(), PHP_EOL;

foreach ($result->segments() as $segment) {
    printf("[%6.2fs → %6.2fs] %s\n", $segment['start'], $segment['end'], $segment['text']);
}

$model->close();
```

It expects 16kHz mono 16-bit PCM WAV input, and as of v0.1 does not support
Windows. Convert other formats first:

```bash
ffmpeg -i in.mp3 -ar 16000 -ac 1 -c:a pcm_s16le out.wav
```

Alternatives worth knowing about:

- **[codewithkyrian/whisper.php](https://github.com/CodeWithKyrian/whisper.php)** —
  an FFI binding to whisper.cpp. Broader reach than ext-whisper (PHP 8.1+,
  including Windows) and it handles audio decoding for you.
- **[openai-php/client](https://github.com/openai-php/client)** — if a hosted API
  is acceptable rather than local inference.

## Security

The `transcribe()` method in this repository interpolates its `$audio` argument
directly into a Python program, which is then piped to an interpreter. The
`escapeshellarg()` call guards the surrounding shell but not the generated Python,
so **any caller who controls the file path can execute arbitrary code**. The
`// TODO: Sanitize input` in the source was never addressed.

This was never fixed because the project was abandoned before release. Treat the
code here as an illustration of what not to do.

## Why it was archived

- `composer.json` contained a trailing comma, making it invalid JSON. The package
  could never be installed and Packagist would have rejected it.
- Only the model name was ever passed through to Python; the `device`,
  `download_root` and `in_memory` options were accepted and silently discarded.
- `availableModels()` returned array indices rather than model names.
- Command output was captured with backticks, discarding both stderr and the
  exit status, so failures were indistinguishable from empty transcripts.
- The problem it set out to solve is now solved well by the packages listed above.

## License

&copy; 2023 Theta Labs, LLC and Sean Talbot

Released under the MIT License. See [LICENSE](LICENSE) for further details.
