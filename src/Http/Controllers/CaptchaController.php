<?php

namespace Suizide\Captcha\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Suizide\Contact\Models\Contact;
use Suizide\Contact\Mail\ContactMailable;
use Suizide\Contact\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Suizide\Captcha\Models\Captcha;

class CaptchaController extends Controller
{
    public function index()
    {
       function generate()
      {
          $num1 = rand(2, 5);
          $num2 = rand(6, 9);
          $actionNumber = rand(1, 3);

          $ar = [];
          $arr['num1'] = $num1;
          $arr['num2'] = $num2;


          switch ($actionNumber)
          {
              case 1:
                  $arr['question'] = $num1 . " + " . $num2 . " = ? ";
                  $arr['answer'] = addition($num1, $num2);
                  return $arr;
                  break;

              case 2:
                  $arr['question'] = $num2 . " - " . $num1 . " = ? ";
                  $arr['answer'] = substruction($num1, $num2);
                  return $arr;
                  break;

              case 3:
                  $arr['question'] = $num1 . " * " . $num2 . " = ? ";
                  $arr['answer'] = multiplication($num1, $num2);
                  return $arr;
                  break;
          }
      }

       function addition($num1, $num2)
      {
          return $num1 + $num2;
      }

       function substruction($num1, $num2)
      {
          return $num2 - $num1;
      }

       function multiplication($num1, $num2)
      {
          return $num1 * $num2;
      }

      $img = imagecreate(100, 20);
      $textbgcolor = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
      $textcolor = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
      $clientIP = \Request::ip();
      $txt = generate();
      imagestring($img, 5, 0, 0, $txt['question'], $textcolor);
      ob_start();
      header('Content-type: image/png');
      imagepng($img);
      printf('<img src="data:image/png;base64,%s"/ width="200" style="margin-top: -8px;margin-left: -8px;">', base64_encode(ob_get_clean()));

      Captcha::where('ip', $clientIP)->delete();
      $newCaptcha = new Captcha;
      $newCaptcha->question = $txt['question'];
      $newCaptcha->answer = $txt['answer'];
      $newCaptcha->ip = $clientIP;
      $newCaptcha->save();
    }

    public function create()
    {
        //
    }

    public function store(StoreContactRequest $request)
    {

        echo Cookie::get('cokkieKey');
        dd( $request);
        // echo $request->session()->get('');
        // echo ($request->_answer);
         // $this->validate( $request, [
         //     '_answer'=>'required|simple_captcha'
         // ]);
         //  Mail::to(config('contact.send_email_to'))->send(new ContactMailable($request->message, $request->name));
         //  Contact::create($request->all());
         //  return redirect(route('contact'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
