<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAbsentNotification extends Notification
{
    use Queueable;

    public $student;
    public $date;

    public function __construct($student, $date)
    {
        $this->student = $student;
        $this->date = $date;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Student Attendance Alert')
            ->greeting('Hello Parent,')
            ->line('Your child was marked absent.')
            ->line('Student: ' . $this->student->first_name . ' ' . $this->student->last_name)
            ->line('Date: ' . $this->date)
            ->line('Please contact the school if necessary.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->student->first_name . ' was absent today.',
            'student_id' => $this->student->id,
        ];
    }
}