<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplyRequest;
use App\Http\Requests\UpdateApplyRequest;
use App\Models\Apply;
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
     * @return Response
     */
    public function store(StoreApplyRequest $request) {
        //
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
