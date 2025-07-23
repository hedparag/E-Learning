<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentMarksMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $total_marks;
    public $marks;
    public $name;


    public function __construct($title, $total_marks, $marks, $name)
    {
        $this->title = $title;
        $this->total_marks = $total_marks;
        $this->marks = $marks;
        $this->name = $name;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student Marks Details',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Frontend.student-dashboard.enrolled-courses.mail.scoreMail',
            with: [
                'course_name' => $this->title,
                'total' => $this->total_marks,
                'name' => $this->name,
                'marks' => $this->marks,

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
