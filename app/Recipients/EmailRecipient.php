<?php
namespace App\Recipients;

use Illuminate\Notifications\Notifiable;

class EmailRecipient{
    use Notifiable;
	public $email = "";
	public function __construct($email)
    {
        $this->email = $email;
    }
}