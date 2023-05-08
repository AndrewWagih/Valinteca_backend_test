<?php 
namespace App\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MailtrapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /* 
        notes :-
        you will found postman collection with questions key to test code in https://github.com/AndrewWagih/Valinteca_backend_test/blob/main/task%20backend.postman_collection.json
    
    */
    
    private $tries = 5; 
    private $timeout = 5;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://mailtrap.io/api/v1/',
            'Accept' => 'application/json',
            'Api-Token' =>'76b18f4d3ceb483eea7d817496f63a6a',
            'Content-Type' => 'application/json',
        ]);

        try {
            $response = $client->post('send', [
                "to" =>  [
                    [
                        "email" =>  "andrewwagih@gmail.com",
                        "name" =>  "Andrew Wagih"
                    ]
                ],
                "from" => [
                    "email" =>  "eng.andrewwagih@gmail.com",
                    "name" =>  "Example Sales Team"
                ],
                "headers" =>  [
                    "X-Message-Source" =>  "dev.mydomain.com"
                ],
                "subject" =>  "Your Example Order Confirmation",
                "text" =>  "Congratulations on your order no. 1234",
                "category" =>  "API Test"
                  
            ]);

            if ($response->getStatusCode() == 201) {
                
                Log::info('Email sent successfully.');
            } else {
                Log::error('Failed to send email.');
            }
        } catch (RequestException $e) {
            if ($this->attempts() < $this->tries) {
                $this->release($this->timeout);
            } else {
                Log::error('Failed to send email after ' . $this->tries . ' attempts.');
            }
        }
    }
}


