<?php

namespace App\Http\Requests\TwoFactor;

use App\Rules\ValidTwoFactorToken;
use App\TwoFactor\TwoFactor;
use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{

    protected $twofactor;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(TwoFactor $twofactor)
    {
        $this->twofactor = $twofactor;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setUserResolver($this->userResolver());
        dd($this->user());
        return [
            'token' => [
                'required',
                new ValidTwoFactorToken($this->user(), $this->twofactor)
            ]
        ];
    }

    public function userResolver()
    {
        return function () {
            return User::find(session('twofactor')->user_id);
        };
    }
}
