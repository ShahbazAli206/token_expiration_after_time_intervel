<?php

namespace App\Http\Controllers;


use App\Mail\HelloMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    public function mailform()
    {
        return view('mail.contact');
    }
    public function sendmail (Request $req)
    {
        $emails = [
        
            'email' => $req->get('email'),
        
            'cc' => $req->get('cc'),
        
            'bcc' => $req->get('bcc')
        ];
        
        $details = [
        
            'subject' => $req->get('subject'),
        
            'body' => $req->get('body'),
        ];
        if($emails["cc"] =='' && $emails["bcc"] == ''){
        Mail::to($emails['email'])->send(new HelloMail($details));
        return redirect("mail/contact")->with('status', 'Email sent Successfully!'); 
        }

        elseif($emails["bcc"] =='')
        {
        Mail::to($emails['email'])->cc($emails['cc'])->send(new HelloMail($details)); 
        return redirect("mail/contact")->with('status', 'Email sent Successfully!');
        }
        else
        {
            Mail::to($emails['email'])->cc($emails['cc'])->bcc($emails['bcc'])->send(new HelloMail($details));
            return redirect("mail/contact")->with('status', 'Email sent Successfully!');
        }
    }
}