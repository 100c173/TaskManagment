<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaskFilter
{
    protected Request $request;
    protected Builder $builder;

    protected array $filters = [
        'priority',
        'status_id',
        'user_id',
        'created_by',
        'title',
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters as $filter) {
            if ($this->request->filled($filter)) {
                $this->$filter($this->request->input($filter));
            }
        }

        return $this->builder;
    }

    // =====================
    // Individual filters
    // =====================

    protected function priority(string $value): void
    {
        $this->builder->where('priority', $value);
    }

    protected function status_id(int $value): void
    {
        $this->builder->where('status_id', $value);
    }

    protected function user_id(int $value): void
    {
        $this->builder->where('user_id', $value);
    }

    protected function created_by(int $value): void
    {
        $this->builder->where('created_by', $value);
    }

    protected function title(string $value): void
    {
        $this->builder->where('title', 'like', "%{$value}%");
    }
}
