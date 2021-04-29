<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        $config = Config::firstOrNew();
        
        $title = $config->welcome;
        $cq1 = $config->cq1;
        $cq2 = $config->cq2;


        return view('auth.register',compact('title', 'cq1', 'cq2'));
    }

    //overrode to avoid login
    public function register(Request $request) {
        

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
}   
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string','same:password'],
            'knowme' => ['required', 'string', 'max:255'],
            'city' => ['required', 'max:255'],
            'state' => ['required', 'max:2'],
            'bowl' => ['required', 'numeric', 'min:0','max:300'],
            'cq1' => ['required', 'max:255'],
            'cq2' => ['required', 'max:255'],
            'favsport' => ['required', 'max:255'],
            'news' => ['required', 'max:255'],
            'smack' => ['required', 'max:255'],



        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'lastname' => $data['lastname'],
            'nickname' => $data['nickname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'knowme' => $data['knowme'],
            'city' => $data['city'],
            'state' => $data['state'],
            'bowling' => $data['bowl'],
            'cq1' => $data['cq1'],
            'cq2' => $data['cq2'],
            'favsport' => $data['favsport'],
            'news' => $data['news'],
            'smack' => $data['smack']
        ]);

        
        
    }
}
