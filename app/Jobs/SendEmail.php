<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Commonhelper;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $toemail;
    protected $data;
    protected $template;
    protected $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toemail,$data,$template,$subject)
    {
        $this->toemail = $toemail;
        $this->data = $data;
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Commonhelper::sendmail($this->toemail ,$this->data,$this->template,$this->subject);
    }
}
