<?php
// app/Mail/TicketUpdatedMail.php
namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $changedFields;
    public $newComment;
    




    public function __construct(Ticket $ticket, array $changedFields ,$newComment = null)
    {
        $this->ticket = $ticket;
        $this->changedFields = $changedFields;
        $this->newComment = $newComment; // Store the new comment
       
    }


    public function build()
    {
        info($this->newComment);
        return $this->subject('Ticket Updated: ' . $this->ticket->id)
        ->view('emails.ticket_updated') // Specify the view for the email
        ->with([
            'ticket' => $this->ticket,
            'changedFields' => $this->changedFields,
            'newComment' => $this->newComment, // Pass new comment to the view
        ]);
    }
}
