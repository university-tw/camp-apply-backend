<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplyRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            # 身份驗證
            'email' => 'required|email',
            'password' => 'required',

            # 個人資料
            'name' => 'required',
            'tw_id' => 'required|tw_id',
            'address' => 'required',

            # 手機
            'phone' => 'required',
        ];
    }
}
