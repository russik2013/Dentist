<?php namespace Modules\Message\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller {
	
	public function index()
	{
		return view('message::index');
	}

    public function message(Request $request)
    {

      //  dd($request['login'], $request['password']);

        $user  = 'z.kon2009@gmail.com';

        $pass = 'drugak19051996';

        $connect = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user, $pass);

        if (!$connect) {echo 'Failed'; die;}

        $mails = imap_search($connect, 'UNSEEN');

        $message = '';
        for($i = count($mails)-10; count($mails) > $i; $i ++){
            $structure = imap_header($connect, $mails[$i]);
            $message.= '<tr id ="'.$i.'"> <td>'.imap_utf8($structure->subject).'</td> </tr>';
        }
       // dd($message);
        return ['mass' => $message];
     // $structure = imap_header($connect, $mails[0]);
     //   dd( imap_utf8($structure->subject));
       // $mail = imap_fetchbody($connect, $mails[0], '1');
       // $mail = imap_utf8($mail);
      //  $mail = trim($mail, " \n.");
      //  $mail = base64_decode($mail);

       // dd($mail);
        //   return ['mass' => $parse];

      //  $mail= imap_body($connect, $mails[0]);

     //   $mail = imap_utf8($mail);

     //   $mail = iconv('KOI8-R', 'utf-8', $mail);


    }



}