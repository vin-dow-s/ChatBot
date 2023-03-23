<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{
    public function sendChat(Request $request): string
    {
        $result = OpenAI::completions()->create([
            'max_tokens' => 150,
            'model' => 'text-davinci-003',
            'prompt' => $request->input('input')
        ]);

        $response = array_reduce(
            $result->toArray()['choices'],
            fn(string $result, array $choice) => $result . $choice['text'], ""
        );

        return $response;
    }
}
