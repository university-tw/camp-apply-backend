<?php

namespace App\Http\Controllers;

use App\Events\CampApply;
use App\Http\Requests\StoreApplyRequest;
use App\Http\Requests\UpdateApplyRequest;
use App\Models\Apply;
use App\Models\Group;
use App\Models\Offer;
use App\Models\User;
use App\Notifications\CampApplyNotice;
use Illuminate\Http\Response;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreApplyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreApplyRequest $request)
    {
        if (auth()->check()) $user = auth()->user();
        else $user = User::firstOrCreate(['email' => $request->email], [
            'email' => $request->email,
            'password'=> bcrypt(\Str::random(32)),
            ])->first();

        $user->update($request->only([
            'name',
            'tw_id',
            'phone',
            'parent_phone',
            'organization',
            'address',
        ]));

        $offer = Offer::find($request->offer_id);

        $apply = new Apply();
        $apply->user_id = $user->id;
        $apply->camp_time()->associate($request->camp_time);
        $apply->offer()->associate($request->offer_id);
        $apply->data = $request->data ?? [];
        $apply->bank_account = $request->bank_account;
        $apply->bank_code = $request->bank_code;
        $apply->bank_comment = $request->bank_comment;

        if ($offer->group) {
            if ($request->group_id) {
                $apply->group()->associate($request->group_id);
            } else if ($request->group_name) {
                $group = new Group();
                $group->name = $request->group_name;
                $group->camp_id = $request->camp_id;
                $group->save();
                $apply->group()->associate($group->id);
                $apply->save();
                $user->notify(new CampApplyNotice($apply));
                return response()->json([
                    'message' => 'success',
                    'group_id' => $group->id
                ]);
            } else {
                abort(400, 'group_id or group_name is required');
            }
        }

        if ($offer->limit) {
            if ($offer->limit <= $offer->applies()->count()) {
                abort(400, '人數已滿');
            }
        }

        $apply->save();
        CampApply::dispatch($user, $apply);
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
    public function show(Apply $apply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplyRequest $request
     * @param Apply $apply
     * @return void
     */
    public function update(UpdateApplyRequest $request, Apply $apply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Apply $apply
     * @return void
     */
    public function destroy(Apply $apply)
    {
        //
    }
}
