<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherCourseStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $status;
    public $abc;
    public $class;
    public $title;
    public function __construct($name,$status,$class,$abc,$title)
    {
         $this->name = $name;
         $this->status=$status;
         $this->class=$class;
         $this->abc=$abc;
         $this->title=$title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teacher Course Status Updation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Admin.Mail.courseApprove',
            with: [
            'name' => $this->name,
            'status' => $this->status,
            'class'=>$this->class,
            'abc'=>$this->abc,
            'title'=>$this->title
        ],
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
