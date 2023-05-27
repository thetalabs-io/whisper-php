<?php

namespace Whisper;

class Whisper
{
    const SAMPLE_RATE = 16000;
    const CHUNK_LENGTH = 30;
    const N_SAMPLES = self::CHUNK_LENGTH * self::SAMPLE_RATE;

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

    public function __construct(string $name, string $device, string $download_root = "~/.cache/whisper", bool $in_memory = false)
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
    public static function loadModel(string $name, string $device, string $download_root = "~/.cache/whisper", bool $in_memory = false): static
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

    /**
     * Open an audio file and read as mono waveform, resampling as necessary
     *
     * @param string $file
     * @param int $sr
     * @return void     ---  A NumPy array containing the audio waveform, in float32 dtype. TODO
     */
    public function loadAudio(string $file, int $sr = self::SAMPLE_RATE)
    {

    }

    public function padOrTrim(array $array, int $length = self::N_SAMPLES, int $axis = -1)
    {
        // TODO
    }

    public function logMelSpectrogram()
    {
        // TODO
    }

    public function decodingOptions()
    {
        // TODO
    }

    public function decodingResult()
    {
        // TODO
    }

    public function decode()
    {
        
    }

    public function detectLanguage()
    {

    }

    public function modelDimensions()
    {

    }

    public function transcribe()
    {
        
    }
}