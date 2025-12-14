<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\FerryID;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ferry_code' => ['required', 'string'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ])->after(function ($validator) use ($data) {

            // 🔒 Validate Ferry ID BEFORE user creation
            $ferryExists = FerryID::where('code', $data['ferry_code'] ?? null)->exists();

            if (!$ferryExists) {
                $validator->errors()->add(
                    'ferry_code',
                    'Invalid Ferry ID'
                );
            }
        });
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => 'customer',
            'ferry_code' => $data['ferry_code'],
        ]);
    }
}
