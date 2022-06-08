<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CarFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const MODEL = 'model';
    public const YEAR = 'year';


    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::MODEL => [$this, 'model'],
            self::YEAR => [$this, 'year'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function model(Builder $builder, $value)
    {
        $builder->where('model', 'like', "%{$value}%");
    }

    public function year(Builder $builder, $value)
    {
        $builder->where('year', 'like', "%{$value}%");
    }

    /* public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    } */
}
