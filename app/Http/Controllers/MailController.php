<?php

namespace App\Http\Controllers;
use Auth;
use App\Mail\NotificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function index()
    {
      return view('admin.send');
    }

    public function send(Request $request) {
        
        
        
        $this->validate($request, [
            //'from'      => 'required|email',
            'to'        => 'required',
            'message'   => 'required',
            'subject'   => 'required',
        ]);
        $actionURL = null;
        $actionText = null;
        $endMessage = null;
        if  ($request->has('sendButtonCheck')) {
            $sendButton = true;
            if ($request->link != "") {
                $actionURL = $request->link;                
            } else {
                $actionURL = "http://nolanbowl.com";
            }
            if ($request->actionLink != "") {
                $actionText = $request->actionLink;                
            } else {
                $actionText = "Go to Nolan Bowl Now";
            }
            if ($request->addafter != "") {
                $endMessage = $request->addafter;
                $endMessage = preg_split("/\r\n|\n|\r/", $endMessage);
            }
        }
        //dd($actionText);
        //first we get the to
        $to = $request->to;
        //then the message
        $message = $request->message;
        //turn into array
        $message = preg_split("/\r\n|\n|\r/", $message);

        //then the subject
        $subject = $request->subject;
        //dd($message);
        if ($to == 'myself') {
            //only send to myself
            $email = Auth::user()->email;
           
            
            //dd($message);
            //send only to myself ($greeting, $introLines, $actionText, $actionUrl, $level, $outroLines)
            Mail::to($email)->send(new NotificationEmail($subject, "Hello,", $message,  $actionText, $actionURL, null, $endMessage));
        
        } elseif ($to == 'viewemail') {

            return new NotificationEmail($subject, "Hello,", $message,  $actionText, $actionURL, null, $endMessage);


        } elseif ($to == 'everyone') {
            //send to everyone
            $users = User::all();
            foreach ($users as $user) {
                $email = $user->email;
                //send only to myself ($greeting, $introLines, $actionText, $actionUrl, $level, $outroLines)
                Mail::to($email)->send(new NotificationEmail($subject, "Hello,", $message,  $actionText, $actionURL, null, $endMessage));

    
                
            }


        } elseif ($to == 'current') {
            //everyone marked current            
            $users = User::where('status','=','current')->get();
            foreach ($users as $user) {
                $email = $user->email;
                //send only once
                //send only to myself ($greeting, $introLines, $actionText, $actionUrl, $level, $outroLines)
                Mail::to($email)->send(new NotificationEmail($subject, "Hello,", $message,  $actionText, $actionURL, null, $endMessage));
            }
            
        } elseif ($to == 'missing') {
            //everyone marked current            
            $users = User::where('status','<>','current')->get();
            foreach ($users as $user) {
                $email = $user->email;
                //send only once
               //send only to myself ($greeting, $introLines, $actionText, $actionUrl, $level, $outroLines)
               Mail::to($email)->send(new NotificationEmail($subject, "Hello,", $message,  $actionText, $actionURL, null, $endMessage));
            }
        } else {
            //uh oh
            back()->with('errors', 'Bad To');
        }


        
        return back()->with('success', 'Email(s) sent!');
    }
}