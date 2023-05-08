<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class ExternalApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /* 
        notes :-
        you will found postman collection with questions key to test code in https://github.com/AndrewWagih/Valinteca_backend_test/blob/main/task%20backend.postman_collection.json
    
    */
    
    private $retryCount = 0;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        } catch (\Exception $e) {
            if ($this->retryCount < 5) {
                $this->retryCount++;
                $this->release(5 * pow(2, $this->retryCount));
            } else {
                Log::error('API rate limit reached. Job failed: ' . $e->getMessage());
            }
        }
    }
}
