<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Image;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Reply;
use App\Models\User;
use Auth;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Notification;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartment = Apartment::find(1);
        $apartments = Apartment::where('user_id', Auth::user()->id)->get();
        //return $apartment;
        //return $apartment->users;
        //return $apartment->images;
        return view('renter.apartments.index')->with([
            'apartments' => $apartments
            //'apartments' => Apartment::all(),
            //'images' => Image::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('renter.apartments.create')->with([
            'cities' => City::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Apartment::create($request->all());

        $last_id = Apartment::latest()->first()->id;
        
        $images = array();

        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                /*$image_name = md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'public/muliple_image/';
                $image_url = $upload_path.$image_full_name;
                //$file->move($upload_path, $image_full_name);
                $images[] = $image_url; */
                //$image_name = md5(rand(10,100));
                //$ext = strtolower($file->getClientOriginalName());
                //$image_full_name = $image_name.'.'.$ext;
                $image_name = $file->getClientOriginalName();
                $file->move('storage/', $image_name);
                //$imageName = $file->getClientOriginalName();
                $images[] = $image_name;

            }
            foreach ($images as $image) {
                Image::insert([
                    'image' => $image,
                    'apartment_id' => $last_id
                ]);
            }
        }

        return back();

        exit;

        dd($request->all());

            $image = new Image;
            $images = $request->file('files');
            
            //if ($request->hasFile('files')) {
                foreach ($images as $item) {
                    
                    //$imageName = $item->getClientOriginalName();
                    //$item->move('image', $imageName);
                    //$image->url = $item->getClientOriginalName();
                    $path = $item->store('/images/resource', ['disk' => 'my_files']);
                    return $path;
                    $image->url = $path;
                    $image->apartment_id = 5; //$product->id;
                    $image->save();

                    /*$var = date_create();
                    $time = date_format($var, 'YmdHis');
                    $imageName = $time . '-' . $item->getClientOriginalName();
                    $item->move(base_path() . '/uploads/file/', $imageName);
                    $arr[] = $imageName; */
                }
                //$image = implode(",", $arr);
            //}

            return "exit";

        /*$image = new Image;
        $image->url = "OK";
        $image->apartment_id = 5;
        $image->save();
        return "AA"; */
        
        /*$this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:855',
        ]); */
        //$apartment = new Apartment;
        


        $apartments = Apartment::all();
        //return $apartments;
        $files = $request->file('files');
        return $files;
        foreach ($files as $apartment) {
            echo "OKaaaaaa";
        }
        return $files;
        /*$apartment->address = $request->name;
        $product->description = $request->description;
        $product->save(); */
        //return $request->file('images');
        if($files = $request->file('images')){
            foreach($files as $file){
                echo "Slika";
                /*$name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name; */
            }
        

        /*if ($request->file('images')) {
            
            foreach ($request->file('images') as $imagefile) {
                
                //$image = new Image;
                //$path = $imagefile->store('/images/resource', ['disk' => 'my_files']);
                //$image->url = $imagefile;   //$path;
                //$imageName = $imagefile->getClientOriginalName();
                //$image->move('storage/', $imageName);
                //$image->apartment_id = 5; //$product->id;
                //$image->save();
              } */
        } else {
            return "Nije";
        }
        
          //return "OKK";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        return view('renter.apartments.show')->with('apartment', Apartment::find($id));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('renter.apartments.edit')->with([
            'apartment' => Apartment::find($id),
            'cities' => City::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Apartment::find($id)->update($request->all());
        return "Update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();
        return redirect()->back()->with('message', 'success|Record deleted.');
        
        /*redirect()->to('/')->with('message', 'success|Record updated.');
        return $apartment;
        $user->delete();
        return "Delete";*/
    }


    public function read (Request $request)
    {
        /*auth()->user()
        ->unreadNotifications
        ->when('182eba69-0e30-4060-ae59-05c544f5568c', function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead(); */

        Auth::user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();

        return "OK";

        Auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

        return $request->all();
    }

    public function deleteImage ($id)
    {
        $image = Image::find($id);
        $image->delete();
        return redirect()->back()->with('success', 'your message,here');  

    }

    public function message()
    {
        $messages = Message::all();
        $replies  = Reply::all();
        $count = 2;
        
        return view('renter.apartments.message')->with([
            'messages' => $messages,
            'replies' => $replies,
            'count' => $count,
        ]);
    }

    public function reply (Request $request)
    {
        $user = User::all();
        Reply::insert([
            'content' => $request->input('content'),
            'message_id' => $request->input('message_id'),
            'user_id' => Auth::user()->id,
        ]);
        Notification::send($user, new MessageNotification($request->content));
        return redirect()->route('renter.apartment.message');
    }

    public function contact (Request $request) 
    {
        return $request->all();
        Message::insert([
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'apartment_id' => $id,
        ]);
        return "Poruka poslana";
        return view('user.apartments.contact');
    }

    public function profile ()
    {
        return view('renter.profile');
    }

    public function editProfile ()
    {
        return view('renter.edit-profile');
    }
}
