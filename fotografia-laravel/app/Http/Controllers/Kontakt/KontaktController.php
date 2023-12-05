<?php

namespace App\Http\Controllers\Kontakt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class KontaktController extends Controller
{
    public function wyslijFormularz(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);
    
        // Wyślij e-mail
        Mail::to('szambo.ind@gmail.com')->send(new ContactFormMail($data));
    
        return response()->json(['message' => 'E-mail wysłany pomyślnie']);
    }
}
