<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Message;
use Validator;
use App\Mail\SendMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    
    
    public function index()
    {
      
 
      
      return view('contact');
      
      
    }
   public function send_message(Request $request){
 
        $form_data = $request->only(['name','email', 'message','phone','termeni']);
        $validationRules = [
            'name'    => ['required','min:3'],
            'email'   => ['required','email'],
            'message'   => ['required','min:10'],
            'phone'   => ['required','min:10'],
            'termeni'   => ['required'],
          
        ];
      
        $validationMessages = [
            'name.min'   => "Campul nume trebuie sa aiba minim :min caractere",
            'email.email'    => "Trebuie sa introduci o adresa de :attribute valida!",
            'message.min'   => "Campul mesaj trebuie sa aiba minim :min caractere",
            'phone.min'   => "Campul telefon trebuie sa aiba minim :min caractere",
            'name.required'    => "Campul nume este obligatoriu!",
            'email.required'    => "Campul email este obligatoriu!",
            'message.required'    => "Campul message este obligatoriu!",
            'phone.required'    => "Campul telefon este obligatoriu!",
            'termeni.required'    => "Te rugam sa accepti termenii si conditiile!",
        ];
        $validator = Validator::make($form_data, $validationRules, $validationMessages);
        if ($validator->fails())
            return ['success' => false, 'error' => $validator->errors()->all()];  
        else{
            $date_de_salvat = Message::create($request->all()); 
            Mail::to(setting('site.email'))->send(new SendMessage($date_de_salvat));
            return ['success' => true];
        }
              
    }
    
    
}