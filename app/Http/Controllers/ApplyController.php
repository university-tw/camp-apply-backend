<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplyRequest;
use App\Http\Requests\UpdateApplyRequest;
use App\Models\Apply;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Response;

class ApplyController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreApplyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreApplyRequest $request) {
        auth()->user()->update($request->only([
            'name',
            'tw_id',
            'phone',
            'parent_phone',
            'organization',
            'address',
        ]));

        $offer = Offer::find($request->offer_id);

        $apply = new Apply();
        $apply->user_id = auth()->user()->id;
        $apply->camp_time()->associate($request->camp_time);
        $apply->offer()->associate($request->offer_id);
        $apply->data = [];
        $apply->bank_account = $request->bank_account;
        $apply->bank_code = $request->bank_code;
        $apply->bank_comment = $request->bank_comment;

        if ($offer->group) {
            if($request->group_id) {
                $apply->group()->associate($request->group_id);
            } else if($request->group_name) {
                $apply->group()->create([
                    'name' => $request->group_name,
                    'camp_id' => $request->camp_id,
                ]);
            } else {
                abort(400, 'group_id or group_name is required');
            }
        }

        $apply->save();

        return \response()->json([
            'message' => 'success',
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param Apply $apply
     * @return void
     */
    public function show(Apply $apply) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplyRequest $request
     * @param Apply $apply
     * @return void
     */
    public function update(UpdateApplyRequest $request, Apply $apply) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Apply $apply
     * @return void
     */
    public function destroy(Apply $apply) {
        //
    }
}
