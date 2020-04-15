<?php
namespace App\Http\Controllers\Auth\Api ;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Person;
use App\User;
use App\Address;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Nexmo\Response;

class AuthController extends Controller
{
    use HasApiTokens, Notifiable, HasRoles;
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return string
     */
    public function register(Request $request)
    {
        // dd($request); 
        $user = Person::where('email', $request->email)->with('user')->first();
        // dd($user);
                
        if ($user != null) {
            return response()->json([
                'message' => 'Usuario ya se encuentra registrado!',
            ]);        
        }

        // En caso de que no exista creamos un nuevo usuario con sus datos.
        $address = Address::create([
            'states_id' => $request->states_id, 
            'cities_id' => $request->cities_id, 
            'municipalities_id' => $request->municipalities_id, 
            'parishes_id' => $request->parishes_id,
            'address' => $request->address,
        ]);
        // dd( $address);

        $person = Person::create([
            'type_dni' => $request->type_dni, 
            'dni'      => $request->dni,
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address_id' => $address->id,
        ]);

        $user = User::create([
            'person_id' => $person->id,
            'email' => $person->email,
            'password' => Hash::make($request->password),
        ])->assignRole('client');

        // dd($user);

        return response()->json([
            'message' => 'Usuario creado correctamente.!',
        ]);
    }

    /**
     * Authenticate the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // dd($request);
        try {
           
                $person = Person::whereEmail($request->email)->first();
                // dd($person);

                if ($person == null) {
                    return response()->json([
                        'person' => 'Usuario no registrado'], 401); 
                }

                $user = User::where('person_id', $person->id)->first();

                if (!Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'message' => 'Contraseña incorrecta'], 401);
                }

                $tokenResult = $person->user->createToken('Personal Access Token');
                $token       = $tokenResult->token;

                if ($request->remember_me) {
                    $token->expires_at = Carbon::now()->addWeek(2);
                }
                
                $token->save();
    
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type'   => 'Bearer',
                    'expires_at'   => Carbon::parse(
                        $tokenResult->token->expires_at)
                        ->toDateTimeString(),
                    'role'         => $person->user->getRoleNames(),
                    'message'      => 'Sesion Iniciada',
                    'user'         => Auth::id(),
                    'id'           => $user->id,
                    'name'         => $person->name,
                ]);
    
            
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function logout(Request $request)
    {
        return $request->user()->token();
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Se desconectó con éxito',
        ]);
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
}