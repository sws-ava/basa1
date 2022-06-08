<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mailFromAbout(Request $request)
    {
        $name = $request->formName;
        $mail = $request->formMail;
        $text = $request->formText;
        Mail::send(new ContactUs($name, $mail, $text));
        return ($request);
    }
}
