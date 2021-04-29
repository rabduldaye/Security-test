<?php



namespace App\Http\Controllers\Auth;

use View;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use App\Models\Config;



class LoginController extends Controller

{
   /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

   use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
    *
    * @var string
    */
   protected $redirectTo = '/home';

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('guest')->except('logout');
   }

   public function showLoginForm()
    {
        

        $config = Config::firstOrNew();
        $rules = $config->rules;
        $title = $config->welcome;

        //View::share('title', $title);
        

        
        return view('auth.login', compact('rules', 'title'));
    }

   public function login(Request $request)
   {
       $input = $request->all();
       $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required',
       ]);

       if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
       {
           if (auth()->user()->is_admin == 1) {
               return redirect()->route('admin.index');
           }else{
               return redirect()->route('home.index');
           }
       }else{
           return redirect()->route('login')
               ->with('error','Email-Address And Password Are Wrong.');
       }
   }

   /**
   * Log the user out of the application.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
   public function logout(Request $request)
   {
       Auth::logout();

       $request->session()->invalidate();

       $request->session()->regenerateToken();

       return redirect('/');
   }
}
