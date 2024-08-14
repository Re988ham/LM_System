<?php

namespace App\Jobs;

use App\Services\GeneralServices\ImageComparisonService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SapientPro\ImageComparator\ImageResourceException;

class CompareImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imagePath, $name)
    {
        $this->imagePath = $imagePath;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws ImageResourceException
     */
    public function handle(): void
    {


        $similarImages = (new ImageComparisonService)->compareImage($this->imagePath, $this->name);

        if (!empty($similarImages)) {
            Mail::to('mhranabwdqt971@email.com')->send(new \App\Mail\SimilarImagesMail($similarImages));
        }
    }
}
