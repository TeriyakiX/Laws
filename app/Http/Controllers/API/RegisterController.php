<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CheckCodeRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\SendCodeRequest;
use App\Http\Resources\ConfectionerResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\UserResource;
use App\Mail\VerificationMail;
use App\Models\Confectioner;
use App\Models\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user['token'] =  $user->createToken('Law')->plainTextToken;

        return $this->sendResponse(UserResource::make($user), 'User register successfully.');
    }



    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $user['token'] =  $user->createToken('Law')->plainTextToken;

            return $this->sendResponse(UserResource::make($user), 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function forgotPassword(SendCodeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['status'] = EmailVerification::STATUS_NEW;
        $data['expire_date'] = Carbon::now()->addMinutes(2);
        $data['code'] = rand(1111, 9999);
        DB::beginTransaction();
        try {
            EmailVerification::query()->create($data);
            Mail::to($data['email'])->send(new VerificationMail($data));
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->sendError($exception->getMessage());
        }
        DB::commit();
        return $this->sendResponse( "success",'Code sent to ' . $data['email']);

    }



    public function checkCode(CheckCodeRequest $request): JsonResponse
        {
            $data = $request->validated();

            $verification = EmailVerification::query()
                ->where(['email' => $data['email']])
                ->where(['code' => $data['code']])
                ->where(['status' => EmailVerification::STATUS_NEW])
                ->where('expire_date', '>', now())
                ->first();

            if (!$verification) {
                return $this->sendError('Not found!');
            }
            return $this->sendResponse('success', $data['code'].' - Correct!');

        }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::query()
            ->where(['email' => $data['email']])
            ->first();
        $user->password = Hash::make($data['password']);
        $user->save();
        $user['token'] =  $user->createToken('Tort')->plainTextToken;

        return $this->sendResponse($user->user_type == 1 ? ConfectionerResource::make($confectioner) : UserResource::make($user), 'Password changed!');


    }

    public function logout(Request $request): JsonResponse
    {
        $result = auth()->user()->tokens()->delete();
        return $this->sendResponse( $result,"You have been successfully logged out");
    }

    public function updateProfile(ProfileRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $user->update($data);
        return $this->sendResponse(UserResource::make($user), 'You have been successfully update profile');
    }

    public function deleteAccount(): JsonResponse
    {
        $user = auth()->user();
        $user->delete();
        return $this->sendResponse(UserResource::make($user), 'You have been successfully deleted');
    }

    public function getUser(): JsonResponse
    {
        $user = auth()->user();
        return $this->sendResponse(ProfileResource::make($user), 'Successfully');
    }









}
