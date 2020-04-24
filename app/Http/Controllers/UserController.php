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
        $user = User::with('person.security')->get();

        return response()->json([ 
        'user' => $user
        ]);
    }

    public function profile(Request $request)
    {
        $user = User::with('person.address')->where('id', $request->id)->first();
        
        $profile = Person::with('address')->where('id', $user->person_id)->first();
        // dd($profile);
        return response()->json([ 
            //'profile' => $profile,
        'user' => $user,]);
    }

    /**
     * Se busca con el email xq es lo q introduce el user para cambiar clave
     */
    public function search_User(Request $request){
        $person = Person::whereEmail($request->email)->first();

        $user = User::with('person.security')->where('person_id', $person->id)->first();
        
        // $user = User::with('person.security')->where('id', $request->id)->first();

        return response()->json([ 
        'user' => $user
        ]);
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
        // dd($request); 

        $user = User::with('person')->where('id', $request->id)->first();
        // dd($user->person);
        $person = Person::where('id', $user->person_id)->first();
        // dd($person);
        $address = Address::where('id', $person->address_id)->first();
        // dd($address);
        $question = Security::where('person_id', $person->id)->first();
        // dd($question);
                
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

            $question->question_1 = $request->question_1;
            $question->answers_1 = $request->answers_1;
            $question->question_2 = $request->question_2;
            $question->answers_2 = $request->answers_2;
            $question->question_3 = $request->question_3;
            $question->answers_3 = $request->answers_3;
            $question->save();
          
        }

        // dd($user);

        return response()->json([
            'message' => 'Usuario actualizado',
            // 'address' => $address
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