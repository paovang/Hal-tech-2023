<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Jobs\EmailJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function sendEmail(Request $request)
    {
        // https://mailtrap.io/blog/send-email-in-laravel/

        dispatch(new EmailJobs($request->all()));

        return 'success';
    }


    public function checkData(Request $request)
    {
        if($request['type'] == 'standard' || $request['age'] == 28){
            return 'standard';
        }else{
            return 'variation';
        }
    }
}
