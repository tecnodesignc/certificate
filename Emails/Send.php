<?php

namespace Modules\Certificate\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Send extends Mailable
{
    use Queueable, SerializesModels;


    public $data;
    public $subject;
    public $view;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @param $subject
     * @param $view
     */
    public function __construct($data, $subject, $view)
    {
        $this->data=$data;
        $this->subject=$subject;
        $this->view=$view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)->subject($this->subject);
    }
}
