<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for OpenAI GPT integration
    |
    */
    
    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),
    'model' => env('OPENAI_MODEL', 'gpt-4-turbo'),
    'temperature' => (float) env('OPENAI_TEMPERATURE', 0.9),
    'max_tokens' => (int) env('OPENAI_MAX_TOKENS', 600),
    'system_prompt' => env('OPENAI_SYSTEM_PROMPT', 'You are a helpful assistant.'),
    'timeout' => (int) env('OPENAI_TIMEOUT', 30),
    'base_url' => 'https://api.openai.com/v1',
];
