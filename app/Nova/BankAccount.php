<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BankAccount extends Resource
{
    /**
     * @return string
     */
    public static function label(): string
    {
        return '銀行帳號';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BankAccount>
     */
    public static $model = \App\Models\BankAccount::class;

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
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('名稱', 'name')->sortable(),
            Text::make('帳號', 'account'),
            Select::make('銀行代碼', 'code')->options(function () {
                $bc = json_decode(file_get_contents(resource_path('bank_code.json')));
                $options = [];
                foreach ($bc as $cat => $codes) {
                    foreach($codes as $code) {
                        $options[] = "$cat ($code->bank_code) $code->name";
                    }
                }
                return $options;
            }),
            BelongsToMany::make('營隊', 'camps', Camp::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public
    function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public
    function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public
    function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public
    function actions(NovaRequest $request)
    {
        return [];
    }
}
