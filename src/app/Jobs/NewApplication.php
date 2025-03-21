<?php

namespace App\Jobs;

use App\Models\Result;
use App\Services\AnalyzeApplicationService;
use App\Services\PostulacionesApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    private $postulacionesApiService;

    private $analyzeApplicationService;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->postulacionesApiService = new PostulacionesApiService;
        $this->analyzeApplicationService = new AnalyzeApplicationService;
        $profileData = $this->getUserData($this->data['user_id']);
        $positionData = $this->getPositionData($this->data['position_id']);
        $score = $this->getScore($profileData, $positionData);
        $result = $this->registerResults(
            $this->data['user_id'],
            $this->data['position_id'],
            $score
        );
        //$this->sendResultsToPanel($analisis);
    }

    private function getUserData($userId)
    {
        $user = $this->postulacionesApiService->call('users/'.$userId, []);

        return $user;
    }

    private function getPositionData($positionId)
    {
        $position = $this->postulacionesApiService->call('positions/'.$positionId, []);

        return $position;
    }

    private function getScore($profileData, $positionData)
    {
        $score = $this->analyzeApplicationService->analyze($profileData, $positionData);
        return $score;
    }

    private function registerResults($userId, $positionId, $score) 
    {
        $result = Result::create([
            'user_id' => $userId,
            'position_id' => $positionId,
            'score' => $score
        ]);
        return $result;
    }

    private function sendResultsToPanel($results) {}
}
