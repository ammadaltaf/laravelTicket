<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Filters\V1\QueryFilter;
class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters){
        return $filters->apply($builder);
    }
}
