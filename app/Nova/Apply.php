<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Apply extends Resource {
    public static function label() {
        return '報名';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Apply>
     */
    public static $model = \App\Models\Apply::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable(),

            KeyValue::make('資料', 'data')->rules('array')->nullable()->hideFromIndex(),
            BelongsTo::make('用戶', 'user', User::class),
            Boolean::make('已付款', 'is_paid'),

            Text::make('銀行代碼', 'bank_code'),
            Text::make('銀行帳號', 'bank_account'),
            Text::make('轉帳備註', 'bank_comment')->hideFromIndex(),

            DateTime::make('付款時間', 'paid_at')->hideFromIndex(),

            BelongsTo::make('團隊', 'group', Group::class)->nullable()->displayUsing(function ($group) {
                return $group->name;
            }),
            BelongsTo::make('營隊梯次', 'camp_time', CampTime::class)->displayUsing(function ($camp_time) {
                return $camp_time->camp->name . ' ' . $camp_time->name;
            }),
            BelongsTo::make('營隊方案', 'offer', Offer::class)->displayUsing(function ($offer) {
                return $offer->name;
            }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request) {
        return [
            new Metrics\NewApplicants,
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request) {
        return [];
    }
}
