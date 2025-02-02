<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class BaseBuilder extends Builder
{
    /*
    * search([
    *      'name','email',
    *      'description'=>[
    *          is_trans=>true,
    *          all_lang=>false,
    *          is_relation=>true,
    *      ],
    * ])*/
    public function search(array $columns = [], $search_key = null): static
    {
        $search_key = trim($search_key ?? request()->get('search'));
        if (!$search_key || !count($columns))
            return $this;
        $this->where(function ($q) use ($search_key, $columns) {
            $model_translatable_array = $this->model?->translatable && is_array($this->model->translatable) ? $this->model->translatable : [];
            //foreach search column
            foreach ($columns as $loop_key => $loop_option) {
                $search_key = "%$search_key%";
                $col_name = is_array($loop_option) ? $loop_key : $loop_option;
                $option = is_array($loop_option) ? $loop_option : null;

                if (in_array($col_name, $model_translatable_array)) {
                    $option['is_trans'] = true;
                }
                if (is_array($option)) {
                    if (data_get($option, 'is_relation')) {
                        $relation = explode('.', $col_name);
                        if (count($relation) === 2)
                            $q->orWhereHas($relation[0], fn($q) => $q->where($relation[1], 'like', $search_key));
                    } else if (data_get($option, 'is_trans')) {
                        if (data_get($option, 'all_lang')) {
                            $q->orWhere($col_name . '->ar', 'like', $search_key)->orWhere($col_name . '->en', 'like', $search_key);
                        } else {
                            $q->orWhere($col_name . '->' . App::getLocale(), 'like', $search_key);
                        }
                    }
                } else {
                    $q->orWhere($col_name, 'like', $search_key);
                }
            }
        });
        return $this;
    }

    /**
     * @param array|null $dateRange
     * @return $this
     */
    final public function isCreatedAtRange(?array $dateRange): static
    {
        if(!\Arr::last($dateRange)){
            $dateRange[1] = \Arr::first($dateRange);
        }
        return $this->when($dateRange !== null,
            fn(Builder $q) => $q->whereDate('created_at', '>=', \Arr::first($dateRange))
                ->whereDate('created_at', '<=', \Arr::last($dateRange))
        );
    }

    /**
     * @param array|null $dateRange
     * @return $this
     */
    final public function isUpdatedAtRange(?array $dateRange): static
    {
        if(!\Arr::last($dateRange)){
            $dateRange[1] = \Arr::first($dateRange);
        }
        return $this->when($dateRange !== null,
            fn(Builder $q) => $q->whereDate('updated_at', '>=', \Arr::first($dateRange))
                ->whereDate('updated_at', '<=', \Arr::last($dateRange))
        );
    }

    /**
     * @param int|null $active
     * @return $this
     */
    final public function isActive(?int $active): static
    {
        return $this->when($active !== null, fn(Builder $q) => $q->where('is_active', $active));
    }
}
