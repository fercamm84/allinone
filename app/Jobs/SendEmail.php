<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
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

    protected $process;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($process)
    {
        //Crea el proceso para enviarlo en algun momento:
        $process->type = 'email';
        $process->state = 'TO_SEND';
        $process->save();

        // $this->mailing = $mailing;
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
        $resultado = call_user_func_array(array($SendMailHelper, $this->process->process), array($this->process));

        //Actualiza el proceso
        $this->process->state = 'SENT';
        $this->process->save();
    }

}
