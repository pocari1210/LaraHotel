<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookConfirm extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */

  /** 
   * 
   * constructメソッドの引数を
   * Frontend\BookingControllerで記述を行った
   * $dataとしている
   * 
   */

  public function __construct(private $data)
  {
    //
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Your Booking Is Confirm',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {

    /******************************************
     * 
     * $this->dataはconstructメソッドで記述を行った
     * private $dataを指定している
     * 
     ********************************************/

    $booking = $this->data;

    return new Content(
      view: 'mail.booking_mail',
      with: ['booking' => $this->data],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
