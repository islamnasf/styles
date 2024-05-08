<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Twilio\Rest\Client;


class UserOtp extends Model
{
    use HasFactory;
    protected $fillable = [
        'otp',
        'provider_id',
        'expire_at',
    ];

    //twilio 
    public function sendSMS($receiverNumber)
    { 
        $message='Login otp is' .$this->otp;
        try{
            $account_id=getenv("TWILIO_SID");
            $auth_token=getenv("TWILIO_TOKEN");
            $twilio_number=getenv("TWILIO_NUMBER");

            $client = new Client($account_id,$auth_token);
            
            $client->messages->create($receiverNumber,[
                    'from'=>$twilio_number,
                    'body'=>$message
            ]);

            info('SMS sent Successfully!');


        } catch (\Exception $e) {
            return 'Error sending SMS: ' . $e->getMessage();
        }
    }
    //vonage
    public function send($receiverNumber){
        $message='Login otp is' .$this->otp;
        try{
            $basic  = new \Vonage\Client\Credentials\Basic("7a624c38", "MO9OvZSbuSrJzdPz");
            $client = new \Vonage\Client($basic);
        
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS(
                    $receiverNumber, 'Blkhdma' , $message )
            );

            info('SMS sent Successfully!');


        } catch (\Exception $e) {
            return 'Error sending SMS: ' . $e->getMessage();
        }
    }



    }



