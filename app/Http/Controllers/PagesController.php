<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller
{

    // public function __construct() {
    //     $this->middleware('guest');
    // }

    public function index() {
    	return view('welcome');
    }

    public function about() {
    	$fullname = "Lakshya Saini";
    	$email = "saini.lakshya97@gmail.com";
    	$data = [];
    	$data['fullname'] = $fullname;
    	$data['email'] = $email;
    	return view('pages.about')->withData($data);
    }

    public function contact() {
    	return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'subject' => 'required|min:5',
            'message' => 'required|max:255'
        ]);

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message,
        );

        Mail::send('emails.contacts', $data, function($message) use($data) {
            $message->from('saini.lakshya97@gmail.com');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });

        Session::flash('success', 'Mail sent successfully');

        return redirect('/contact');
    }
}