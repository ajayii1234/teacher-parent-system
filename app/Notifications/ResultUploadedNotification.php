<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResultUploadedNotification extends Notification
{
    use Queueable;

    public $student;
    public $subject;
    public $total;
    public $grade;

    public function __construct($student, $subject, $total, $grade)
    {
        $this->student = $student;
        $this->subject = $subject;
        $this->total = $total;
        $this->grade = $grade;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Result Uploaded')
            ->greeting('Hello Parent,')
            ->line('A new result has been uploaded for your child.')
            ->line('Student: ' . $this->student->first_name . ' ' . $this->student->last_name)
            ->line('Subject: ' . $this->subject)
            ->line('Score: ' . $this->total)
            ->line('Grade: ' . $this->grade)
            ->line('Please log in to view full details.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'New result uploaded for ' . $this->student->first_name,
            'student_id' => $this->student->id,
        ];
    }
}