<?php

namespace App\Jobs;

use App\Services\GeneralServices\ImageComparisonService;
use App\Traits\SendEmailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompareImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SendEmailTrait;

    protected $image;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($image, $name)
    {
        $this->image = $image;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageComparisonService $imageComparisonService)
    {
        $similarImages = $imageComparisonService->compareImage($this->image, $this->name);

        $this->SendWarningEmail('mhranabwdqt971@email.com', $similarImages);
    }
}
