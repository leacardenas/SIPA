<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use App\Artisan;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this -> data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Artisan::call('view:clear');
        // Artisan::call('route:clear');
        // Artisan::call('config:clear');
        // Artisan::call('cache:clear');
        // Artisan::call('config:cache');
        return $this->from('bryan.garro.2510@hotmail.com')->subject('
        New Customer Equiry')->view('dynamic_email_template')->with(
        'data',$this->data);


    }
}
