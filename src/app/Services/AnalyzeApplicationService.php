<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class AnalyzeApplicationService
{
    public function analyze($userData, $positionData)
    {
        //dd($userData);
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a recruiter that analyzes the information of a position and a user and gives a score between 0 and 10 that represents how a good fit is the user for the position',
                ],
                [
                    'role' => 'user',
                    'content' => 'Please give me a score that represent the match of '
                        .' this user: '.json_encode($userData)
                        .' and this position: '.json_encode($positionData)
                        .'. Expected Response example: {"score": 5}',
                ],
            ],
            //'response_format' => ['type' => 'json_object']
            /*'response_format' => [
                'type' => 'json_schema',
                'json_schema' => [
                    'name' => 'analyze_job_application',
                    'schema' => [
                        'type' => 'object',
                        'properties' => [
                            'score' => ['type' => 'string'],
                        ],
                        'required' => ['score'],
                        'additionalProperties' => false,
                    ],
                ],
                'strict' => true,
            ],*/
        ])->choices[0]->message->content;
        return json_decode($response)->score;
    }
}
