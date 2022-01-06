<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Video;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $destination = '/' . $this->video->id . '/' . $this->video->id . '.m3u8';

        $low = (new X264('aac'))->setKiloBitrate(500);
        $high = (new X264('aac'))->setKiloBitrate(1000);

        $media = FFMpeg::fromDisk('videos-temp')->open($this->video->path)->exportForHLS()->addFormat($low, function($filters){
            $filters->resize(640, 480);
        })->addFormat($high, function($filters){
            $filters->resize(1280, 720);
        })->onProgress(function($progress){
            $this->video->update([
                'processing_percentage' => $progress,
            ]);
        })->toDisk('videos')->save($destination);

        $durationInSeconds = $media->getDurationInSeconds();

        $this->video->update([
            'processed' => true,
            'processed_file' => $this->video->id . '.m3u8',
            'duration' => $this->formatDuration($durationInSeconds),
        ]);

        //Delete video from temp
        Storage::disk('videos-temp')->delete($this->video->path);
    }

    public function formatDuration($seconds){
        $duration = gmDate('H:i:s', $seconds);
        return $duration;
    }
}
