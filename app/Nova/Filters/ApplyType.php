<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\BooleanFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class ApplyType extends BooleanFilter
{
    public $name = '報名狀態';

    /**
     * Apply the filter to the given query.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        $origin = collect(['pending', 'paid', 'cancelled']);
        $filter = $origin->filter(fn($item) => $value[$item] ?? false);

        return $query->whereNotIn('status', $origin->diff($filter)->values());
    }

    /**
     * Get the filter's available options.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return [
            '尚未繳費' => 'pending',
            '已繳費' => 'paid',
            '已取消' => 'canceled',
        ];
    }

    public function default()
    {
        return ['pending' => true, 'paid' => true, 'cancelled' => false];
    }
}
