<?php

/**
 * Ulogin.ru auto registration or login.
 */

// namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

// use App\User;
// use App\Models\User;

use App\Models\User;

// use Auth;
use Illuminate\Support\Facades\Auth;

// use Hash;
// use Illuminate\Http\Request;
use Redirect;

use Validator;

class UloginController extends Controller
{
    // Login user through social network.
    public function login(Request $request)
    {
        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, TRUE);

        // dd('$user',$user);

        // $network = $user['network'];

        $email = ($user['network'] ?? 'x')
            . '_' . ($user['uid'] ?? 'x')
            . '_' . ($user['nickname'] ?? 'x')
            . '@php-cat.com';

        // Find user in DB.
        $userData = User::where('email', $email)->first();

        // dd($userData);

        // Check exist user.
        if (!empty($userData->id)) {

            // Check user status.
            // if ($userData->status) {
            // Make login user.
            Auth::loginUsingId($userData->id, TRUE);
            // }
            // // Wrong status.
            // else {
            //     \Session::flash('flash_message_error', trans('interface.AccountNotActive'));
            // }

            return Redirect::back();
        }
        // Make registration new user.
        else {

            // dd('reg $user', $user, $email);

            // $validatedData = $request->validate([
            //     'first_name' => 'nullable',
            //     'last_name' => 'nullable',

            //     "avatar" => "nullable",
            //     "socset" => "nullable",
            //     "socset_id" => "nullable",
            //     // "bd" => "nullable|date",
            //     "bdate" => "nullable|date",
            //     "login_soc" => "nullable",

            //     'first_name' => ['required', 'unique:posts', 'max:255'],
            //     'body' => ['required'],
            // ]);

            $new = [
                'email' => $email,
                'password' => md5(rand(1000, 9999)),
                'name' => ($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''),
            ];

            if (!empty($user['photo']))
                $new['avatar'] = $user['photo'];
            if (!empty($user['network']))
                $new['socset'] = $user['network'];
            if (!empty($user['uid']))
                $new['socset_id'] = $user['uid'];
            if (!empty($user['bdate']))
                $new['bd'] = date('Y-m-d', strtotime($user['bdate']));
            if (!empty($user['nickname']))
                $new['login_soc'] = $user['nickname'];

            if (!empty($user['uid']) && $user['uid'] == 5903492)
                $ne['access'] = 'admin';

            $newUser = User::create($new);


            // // Create new user in DB.
            // $newUser = User::create([
            //     // 'nik' => $user['nickname'] ?? '',
            //     'name' => ($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''),
            //     // 'avatar' => ($user['photo'] ?? ''),
            //     // 'socset' => ($user['network'] ?? ''),
            //     // 'socset_id' => ($user['uid'] ?? ''),
            //     // 'bd' => ($user['bdate'] ?? ''),
            //     // 'login_soc' => ($user['nickname'] ?? ''),
            //     // 'country' => ( $user['country'] ?? '' ),
            //     'email' => $email,
            //     // 'password' => Hash::make(str_random(8)),
            //     'password' => rand(1000000, 9999999),
            //     // 'role' => 'user',
            //     // 'status' => TRUE,
            //     // 'ip' => $request->ip()
            // ]);



            // $ne = [
            //     'avatar' => ($user['photo'] ?? ''),
            //     'socset' => ($user['network'] ?? ''),
            //     'socset_id' => ($user['uid'] ?? ''),
            //     'bd' => !empty($user['bdate']) ? date('Y-m-d', strtotime($user['bdate'])) : '',
            //     'login_soc' => ($user['nickname'] ?? ''),
            //     // // 'country' => ( $user['country'] ?? '' ),
            //     // 'email' => $email,
            //     // // 'password' => Hash::make(str_random(8)),
            //     // 'password' => rand(1000000, 9999999),
            //     // // 'role' => 'user',
            //     // // 'status' => TRUE,
            //     // // 'ip' => $request->ip()
            // ];


            // // $validated = $request->validate([
            // //     // 'title' => 'required|unique:posts|max:255',
            // //     // 'body' => 'required',
            // //     // "id" => "",
            // //     // "head" => "required",
            // //     // "sort" => "required|numeric|min:0|max:99",
            // //     // "status" => "required"
            // //     // ,
            // //     "avatar" => "nullable",
            // //     "socset" => "nullable",
            // //     "socset_id" => "nullable",
            // //     "bd" => "nullable|date",
            // //     "login_soc" => "nullable",
            // // ]);
            // // $validated = $ne->validate($for_validate);

            // $ne['asas'] = 123123;

            // $val = Validator::make($ne, [
            //     "avatar" => "nullable",
            //     "socset" => "nullable",
            //     "socset_id" => "nullable",
            //     "bd" => "nullable|date",
            //     "login_soc" => "nullable",
            // ]);

            // dd($val);

            // if (!empty($user['uid']) && $user['uid'] == 5903492)
            //     $ne['access'] = 'admin';

            // // User::where('id', $newUser->id)
            // User::find($newUser->id)
            //     ->update($ne);



            // Make login user.
            Auth::loginUsingId($newUser->id, TRUE);
            \Session::flash('flash_message', trans('interface.ActivatedSuccess'));
            return Redirect::back();
        }
    }
}
