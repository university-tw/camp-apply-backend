<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplyRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array {
        return [
            'name' => 'nullable|string',
            'email' => 'required|email',

            'tw_id' => 'required|tw_id',

            'data' => 'nullable|array',

            'phone' => 'required|string|starts_with:09|digits:10',
            'parent_phone' => 'required|string|starts_with:09|digits:10',
            'organization' => 'required|string',
            'address' => 'required|string',

            'bank_code' => 'required|string',
            'bank_account' => 'required|string',
            // 'bank_comment' => 'required|string',

            'group_name' => 'unique:groups,name',
            'group_id' => 'exists:groups,id',

            'offer_id' => 'required|exists:App\Models\Offer,id',
            'camp_id' => 'required|exists:App\Models\Camp,id',
            'camp_time' => 'required|exists:App\Models\CampTime,id',
        ];
    }
}
