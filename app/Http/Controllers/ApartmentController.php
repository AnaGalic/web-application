<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Auth;
use App\Models\Message;
use App\Models\Reply;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.apartments.index')->with('apartments', Apartment::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('user.apartments.show')->with([
            'messages' => Message::all(),
            'apartment' => $apartment,
            'replies'   => Reply::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }

    public function getAparmentsByCityId($id) 
    {
        return view('user.apartments.index')->with('apartments', Apartment::all());
    }

    public function sendMessage ($id)
    {
        $apartment = Apartment::find($id);

        $messages = Message::where('apartment_id', $id)->where('user_id', Auth::user()->id)->get();
    
        
        //$message = Message::find(4);
        //return $message->replies;
        return view('user.apartments.message')->with([
            'replies' => Reply::all(),
            'messages' => $messages,
            'apartment' => $apartment,
        ]);
    }

    public function message () 
    {
        
        //$apartment = Apartment::find(2);
        //return Auth::user()->id;
        $apartments = Apartment::all();

        /*foreach ($apartments as $apartment) {
            echo $apartment->title, '<br>';
            foreach ($apartment->messages as $message) {
                echo $message;
                echo $message->content, '<br>';
            }
        }*/

        //return $apartment->messages;

        
        $messages = Message::where('user_id', Auth::user()->id)->get();
        
        
        /*foreach ($messages as $message) {
            echo $message->apartments, '<br>';
        }*/
        
        

        //$message = Message::find(4);
        //return $message->replies;
        return view('user.apartments.message')->with([
            'replies' => Reply::all(),
            'messages' => $messages,
            //'apartments' => $apartments
        ]);
    }

    public function reply (Request $request) 
    {
        
        Reply::insert([
            'content' => $request->input('content'),
            'message_id' => $request->input('message_id'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'your message,here');

        return redirect()->route('user.apartment.message');
    }

    // public function contact (Request $request, $id) 
    public function send (Request $request) 
    {   
        Message::insert([
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
            //'apartment_id' => $id,
            'apartment_id' => $request->input('apartment_id'),
        ]);
        return redirect()->back()->with('success', 'your message,here');
        //return view('user.apartments.contact');
    }

    
}
