<?php

namespace App\Jobs;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\TemplateEmail;
use App\Http\Helpers\SendMailHelper;
use App\Models\Process;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
    * The number of times the job may be attempted.
    *
    * @var int
    */
    public $tries = 5;

    /**
    * The number of seconds the job can run before timing out.
    *
    * @var int
    */
    public $timeout = 30;

    protected $mailing;

    protected $process;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailing)
    {
        $user = Auth::user();

        //Crea el proceso para enviarlo en algun momento:
        $process = new Process;
        $process->type = 'email';
        $process->state = 'TO_SEND';
        $process->process = 'processName';
        $process->comment = null;
        $process->user_id = $user->id;
        $process->save();

        $this->mailing = $mailing;
        $this->process = $process;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $SendMailHelper = new SendMailHelper();
        $SendMailHelper->sendEmailContactUs($this->mailing);

        //Actualiza el proceso
        if($this->process != null){
            $this->process->state = 'SENT';
            $this->process->save();
        }
    }
}
