<?php

namespace App\Mail;

use App\Etudiant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Confirmaion_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $etudiant;

    public function __construct(Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Confirmation à l'examen : ")->markdown('emails.confirm')
                    -> with([
                        'etudiant'=>$this->etudiant,
                        // 'apogee'=>$this->etudiant->Apogee,
                    ])
                    
        ;
    }
}
