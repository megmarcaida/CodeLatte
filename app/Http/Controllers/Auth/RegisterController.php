<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Plans;
use App\Http\Controllers\Controller;
use App\UsersPlan;
use App\BillingInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => 'required|string|max:255|unique:users',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|bool'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['gender'])
        {
            $avatar = 'public/defaults/avatars/male.png';
        }
        else
        {
            $avatar = 'public/defaults/avatars/female.png';
        }
        $days=0;
        if ($data['plan'] != 1)
            $days= 30;
        else
            $days =7;

        $user = User::create([
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => bcrypt($data['password']),
            'slug' => str_slug($data['username']),
            'avatar' => $avatar,
            'plan_id' => $data['plan'],
            'trial_ends_at' => Carbon::now()->addDays($days)
        ]);

        // get the plan after submitting the form

        $plan = Plans::findOrFail($data['plan']);

        // subscribe the user
        if ($data['plan'] != 1) {
            $payment_method_nonce = 'fake-valid-nonce';
            $user->newSubscription('main', $plan->braintree_plan)->create($payment_method_nonce,[
                'email' => $data['email'],
                'firstName' => $data['firstname'],
                'lastName' => $data['lastname'],
            ]);

            $userplan = UsersPlan::create([
                'user_id' => $user->id,
                'plan_id' => $data['plan'],
                'trial_days' => '30',
                'status' => 1
            ]);
        }
        else{
            $payment_method_nonce = 'Trial Period';
            $userplan = UsersPlan::create([
                'user_id' => $user->id,
                'plan_id' => $data['plan'],
                'trial_days' => '7',
                'status' => 1
            ]);
        }

        $billing = BillingInfo::create([
            'user_id' => $user->id,
            'plan_id' => $data['plan'],
            'billing_name' => $plan->name,
            'billing_address'=> '',
            'billing_contact'=> '',
            'billing_method'=> $payment_method_nonce,
            'billing_duedate'=> Carbon::now()->addDays('30')
        ]);



        Profile::create(['user_id'=>$user->id]);



        return $user;
    }

    public function getPlans($slug){
        $plans = Plans::where('slug','=',$slug)->first();
        return view('auth.register',compact("plans"));
    }
}

