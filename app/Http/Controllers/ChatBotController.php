<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{
    public function sendChat(Request $request)
    {
        try {
            $result = OpenAI::completions()->create([
                'max_tokens' => 1000,
                'model' => 'gpt-3.5-turbo-instruct',
                'prompt' => $request->input
            ]);

            $choices = $result->toArray()['choices'] ?? [];

            $response = array_reduce(
                $choices,
                function (string $result, array $choice) {
                    if (isset($choice['text'])) {
                        return $result . $choice['text']; // Concatenate the text to accumulate
                    }
                    return $result;
                },
                "" // Initial value for accumulation
            );

            return $response;
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log the error, return a custom error response)
            dd("Error occurred: " . $e->getMessage());
        }
    }
}
