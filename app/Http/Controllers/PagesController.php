<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function about(){
      $people = [];
      //$people = [ 'Taylor Otwell', 'Dayle Rees', 'Eric Barnes' ];
      return view('pages.about', compact('people'));
    }

    public function contact(){
      $first = 'Fox';
      $last = 'Mulder';

      //PASSING INTO ARGUMENT
      $data = [];
      $data['first'] = 'Douglas';
      $data['last'] = 'Wilson';
      return view('pages.contact', compact('first','last') /*$data*/);

      //USING with-> FOR SINGLE VARIABLE
      /*return view('pages.contact')->with('name',$first);
      //USING with-> FOR MULTIPLE VARIABLES
      return view('pages.contact')->with([
        'first' => 'Stephen',
        'last' => 'Knutter'
      ]);
      */
    }
}
