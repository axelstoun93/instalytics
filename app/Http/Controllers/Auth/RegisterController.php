<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Assistant\DataAssistant;
use App\Repositories\UserRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/';

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
            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function registerClient(Request $request)
    {
        if($request->isMethod('post')) {

            if($request->password !== $request->password_two){
                ['status' => 'Пароли не соответствуют друг другу!' ,'type'=> 'error'];
            }

            if(!empty($request->phone)){
                $request->phone = preg_replace('~\D+~','', $request->phone);
            }


            //Добовляем новому пользователю 5 дней использования сервиса
            $request['pay_day'] =  DataAssistant::nextCountDay(5);
            $request['category'] = 2;

            //Email и логин в системе теперь идентичны
            $request['name'] = $request['email'];

            $validate = Validator::make($request->all(),
                [
                    'email' => 'required|unique:users|email',
                    'phone' => (!empty($request->phone)) ? 'required|unique:users|min:11': '',
                    'pay_day' => 'required',
                    'password' => 'min:6|max:255',
                    'category' => 'required|integer',
                ]);


            if($validate->fails())
            {
                $error = [];
                $response = $validate->messages();
                foreach ($response->all() as $key => $value)
                {
                    $error[$key] = ['status' => $value ,'type'=> 'error'];
                }
                echo  json_encode($error);
                die;
            }

            $userRepository = new UserRepository(new User());

            $result = $userRepository->registerClient($request);

            if($result){
                echo  json_encode($result);
            }

        }
    }

}
