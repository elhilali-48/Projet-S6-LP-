<?php

namespace App\Mail;

use App\Etudiant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Rappel_Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->subject('Rappel de confirmaion : ')->markdown('emails.rappel_confirmation')
                     -> with([
            'etudiant'=>$this->etudiant,
            // 'apogee'=>$this->etudiant->Apogee,
        ]);
    }
}
