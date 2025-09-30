<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest; // Import the custom Request class
use App\Mail\ContactMail;  // تأكد من استيراد الـ Mailable
use App\Mail\ContactMailuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private $admin = "bedoadly12@gmail.com"; // بريد المدير

    public function index()
    {
        return view('contactus');
    }


    public function store(ContactRequest $request)
    {
        // Data is already validated by the ContactRequest class

        // Get validated data
        $name = $request->name;
        $email = $request->email;
        $msg = $request->message;
        $phone = $request->phone ?? 'غير محدد'; // Default if phone is not provided

        // Send email
        Mail::to($this->admin)->send(new ContactMail($name, $phone, $email, $msg));
        Mail::to($email)->send(new ContactMailuser($name));

        return back()->with('message', 'Email sent successfully!');
    }

    }
