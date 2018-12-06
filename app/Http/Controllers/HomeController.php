<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Calendar;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];
        
        $bill=Bill::all();
        foreach ($bill as $key => $value) {
                $events[] = Calendar::event(
                    $value->supplier->name,
                    true,
                    new \DateTime($value->bill_date),
                    new \DateTime($value->bill_date.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    'url' => route('bill.show',$value->id),
	                ]
                );
            }

            $calendar = Calendar::addEvents($events);
            
        return view('home', compact('calendar'));
       
    }
}
