<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function otpSMS($otp, $phone_number)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://basic.unifonic.com/wrapper/sendSMS.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appsid' => 'dd2gFXLZLjAqXmRmlEbbB1nFQYh1Q6',
                'sender' => 'NYTROGIN',
                'msg' => 'رمز الدخول الخاص بك هو ' . $otp,
                'to' => $phone_number
            ),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Basic YWFsZGFyd2lzaEBueXRyb2dpbi5jb206Tnl0cm9naW5AMjAyMA=='
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function sendOtp(Request $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->orWhere('name', 'like', '%' . $request->identifier . '%')->first();
        if ($user && Hash::check($request->password, $user->password)) {

            $otp = rand(10000, 99999);
            $user->otp = $otp;
            $user->save();
            // $this->otpSMS($otp, $user->phone_number);
            Log::info("OTP IS " . $otp);
            return response()->json(array('status' => 'success', 'user_id' => $user->id));
        } else {
            return response()->json(array('status' => 'user not found'));
        }
    }

    public function loginOtp(Request $request)
    {
        $user = User::where('id', $request->user_id)->where('otp', $request->otp)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->with(['message' => 'رمز الدخول خاطئ']);
        }
    }

    public function index()
    {
        $roles = Role::all();
        return view('users.index', compact(['roles']));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'created_by' => auth()->user()->id,
        ]);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($request->area_id == 'null') {
            $user->update($request->except('area_id'));
            $user->update(['area_id' => null]);
        } else {
            $user->update($request->all());
        }
        $user->save();
        Alert::success('تم حفظ المستخدم');
        return redirect()->back();
    }
    public function destroy(User $user)
    {
        $user->delete();
        Alert::danger('تم حذف المستخدم ' . $user->name, 'danger');
        return redirect()->route('users.index');
    }
}
