<?php

namespace Whisper;

class Whisper
{
    protected static array $models = [
        'tiny.en',
        'tiny',
        'base.en',
        'base',
        'small.en',
        'small',
        'medium.en',
        'medium',
        'large-v1',
        'large-v2',
        'large'
    ];

    // TODO: Default to cpu, pass to Python
    public function __construct(protected string $model = 'base', protected string $device = 'cuda', protected string $download_root = '~/.cache/whisper', protected bool $in_memory = false)
    {

    }

    /**
     * Load a Whisper ASR model
     *
     * @param string $name One of the official model names listed by `availableModels()`, or
        path to a model checkpoint containing the model dimensions and the model state_dict.
     *
     * @param string $device The PyTorch device to put the model into (e.g. cuda, cpu)
     *
     * @param string $download_root Path to download the model files; by default, it uses "~/.cache/whisper"
     *
     * @param bool $in_memory Whether to preload the model weights into host memory
     *
     * @return static The Whisper ASR model instance
     */
    public static function loadModel(string $name, string $device, string $download_root = '~/.cache/whisper', bool $in_memory = false): static
    {
        return new static($name, $device, $download_root, $in_memory);
    }

    /**
     * Returns the names of available models
     *
     * @return array List of available models
     */
    public static function availableModels(): array
    {
        return array_keys(static::$models);
    }

    public function transcribe(string $audio)
    {
        $script = <<<PY
import whisper

model = whisper.load_model("{$this->model}")
result = model.transcribe("{$audio}")
print(result["text"])

PY;
        // TODO: Sanitize input

        $script = escapeshellarg($script);

        return `echo {$script} | python3`;
    }
}