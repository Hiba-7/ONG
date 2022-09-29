<?php

namespace App\Models;


use Closure;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\MultipleRecordsFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Database\Eloquent\Builder as BuilderContract;


class Custom extends Relation
{
    use HasFactory;
   
    protected $baseConstraints;

    public function __construct(Builder $query, Model $parent, Closure $baseConstraints)
    {
        $this->baseConstraints = $baseConstraints;

        parent::__construct($query, $parent);
    }

    public function addConstraints()
    {
        call_user_func($this->baseConstraints, $this);
    }

    public function addEagerConstraints(array $models)
    {
        // not implemented yet
    }

    public function initRelation(array $models, $relation)
    {
        // not implemented yet
    }

    public function match(array $models, Collection $results, $relation)
    {
        // not implemented yet
    }

    public function getResults()
    {
        return $this->get();
    }

  
}
trait HasCustomRelations
{
    public function custom($related, Closure $baseConstraints)
    {
        $instance = new $related;
        $query = $instance->newQuery();

        return new Custom($query, $this, $baseConstraints);
    }
}