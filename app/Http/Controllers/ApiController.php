<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Reply only with one emoticon.'],
                ['role' => 'user', 'content' => $request->get('content')],
            ],
        ]);

        return Arr::get($result, 'choices.0.message');
    }
}
