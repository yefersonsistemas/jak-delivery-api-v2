<?php
namespace App\Http\Controllers\Auth\Api ;

use App\BranchOffice;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Person;
use App\User;
// use App\Models\User;
use App\Provider;
use App\Address;
use App\Client;
use App\Courier;
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
        $person_user = Person::where('email', $request->email)->with('user')->first();
        $provider_user = Provider::where('email', $request->email)->with('user')->first();
        // dd($person_user, $provider_user);
                
        if ($person_user != null || $provider_user != null) {
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

        if( $request->role == 'client'){
            // dd('uno');
        $person = Person::create([
            'type_dni' => $request->type_dni, 
            'dni'      => $request->dni,
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        $client = Client::create([
            'person_id' => $person->id,
            'address_id' => $address->id,
        ]);

        $user = User::create([
            'person_id' => $person->id,
            'provider_id' => null,
            'email' => $person->email,
            'password' => Hash::make($request->password),
        ])->assignRole('client');

        
        // dd($user);
        
        // $user->assignRole('client'); 
        
        }

        if( $request->role == 'courier'){
            // dd('dos');
        $person = Person::create([
            'type_dni' => $request->type_dni, 
            'dni'      => $request->dni,
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        $courier = Courier::create([
            'person_id' => $person->id,
            'address_id' => $address->id,
            'type_vehicle' => $request->type_vehicle,
            'bussiness_delivery' => $request->bussiness_delivery,
        ]);

        $user = User::create([
            'person_id' => $person->id,
            'provider_id' => null,
            'email' => $person->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->assignRole('courier');
        }
        
        if($request->role == 'bakery' || $request->role == 'restaurant' || $request->role == 'market'){
            // dd($request->role);
            $provider = Provider::create([
            'type_dni' => $request->type_dni, 
            'dni'      => $request->dni,
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address_id' => $address->id,
            'price_delivery' => $request->price_delivery,
            'typepayment_id' => $request->typepayment_id,
            ]);

            $user = User::create([
                'person_id' => null,
                'provider_id' => $provider->id,
                'email' => $provider->email,
                'password' => Hash::make($request->password),
            ]);

            if($request->role == 'bakery'){
                $user->assignRole('bakery');
            }

            if($request->role == 'restaurant'){
                $user->assignRole('restaurant');
            }

            if($request->role == 'market'){
                
                $user->assignRole('market');
            }
        }

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
            if($request->role == 'client' || $request->role == 'courier'){
                // dd('person');
                $person_user = Person::whereEmail($request->email)->first();
                // dd($person_user->email);

                if ($person_user == null) {
                    return response()->json([
                        'person' => 'Usuario no registrado'], 401);
                }

                $user1 = User::where('person_id', $person_user->id)->first();

                if (!Hash::check($request->password, $user1->password)) {
                    return response()->json([
                        'message' => 'Contraseña incorrecta'], 401);
                }

                $tokenResult1 = $person_user->user->createToken('Personal Access Token');
                $token       = $tokenResult1->token;

                if ($request->remember_me) {
                    $token->expires_at = Carbon::now()->addWeek(2);
                }
                
                $token->save();
    
                return response()->json([
                    'access_token' => $tokenResult1->accessToken,
                    'token_type'   => 'Bearer',
                    'expires_at'   => Carbon::parse(
                        $tokenResult1->token->expires_at)
                        ->toDateTimeString(),
                    'role'         =>   $person_user->user->getRoleNames(),
                    'message'      => 'Sesion Iniciada',
                    'user'         => Auth::id(),
                    'id'           => $user1->id,
                    'name'         => $person_user->name,
                ]);
            }
            
            if($request->role == 'bakery' || $request->role == 'restaurant' || $request->role == 'market'){
                // dd('provider');
                $provider_user = Provider::whereEmail($request->email)->first();
                // dd($provider_user->email);

                if ($provider_user == null) {
                    return response()->json([
                        'provider' => 'Usuario no registrado'], 401);
                }

                $user2 = User::where('provider_id',$provider_user->id)->first();
                
                if(!Hash::check($request->password, $user2->password)){
                    return response()->json([
                        'message' => 'Contraseña incorrecta'], 401);
                }
                
                $tokenResult2 = $provider_user->user->createToken('Personal Access Token');
                $token       = $tokenResult2->token;
                
                if ($request->remember_me) {
                    $token->expires_at = Carbon::now()->addWeek(2);
                }
                
                $token->save();
    
                return response()->json([
                    'access_token' => $tokenResult2->accessToken,
                    'token_type'   => 'Bearer',
                    'expires_at'   => Carbon::parse(
                        $tokenResult2->token->expires_at)
                        ->toDateTimeString(),
                    'role'         =>   $provider_user->user->getRoleNames(),
                    'message'      => 'Sesion Iniciada',
                    'user'         => Auth::id(),
                    'id'           => $user2->id,
                    'name'         => $provider_user->name,
                ]);  
            }
            
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
}