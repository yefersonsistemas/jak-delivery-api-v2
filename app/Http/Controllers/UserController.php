<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Person;
use App\Address;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function profile(Request $request)
    {
        $user = User::with('person')->where('id', $request->id)->first();
        
        $profile = Person::with('address')->where('id', $user->person_id)->first();
        // dd($profile);
        return response()->json([ 
        'user' => $user,
        'profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //  dd($request); 

        $user = User::where('id', $request->id)->first();
        // dd( $user);
        $person = Person::where('id', $user->person_id)->with('user', 'address')->first();
        // dd($person);
        $address = Address::where('id', $person->address_id)->first();
        // dd($address);
                
        if ($person != null) {   
            
            $person->type_dni = $request->type_dni;
            $person->dni = $request->dni;
            $person->name = $request->name;
            $person->lastname = $request->lastname;
            $person->email = $request->email;
            $person->phone = $request->phone;
            $person->save();
            
            $address->address =  $request->address;
            $address->save();

            $user->email = $request->email;
            $user->save();
          
        }
        // dd($user);

        return response()->json([
            'message' => 'Usuario actualizado',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}