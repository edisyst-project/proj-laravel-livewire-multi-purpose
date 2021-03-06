<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'time',
        'status',
        'note',
        'members',
        'color',
        'order_position',
    ];

    protected $casts = [
        'date'    => 'datetime',
        'time'    => 'datetime',
        'members' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'SCHEDULED' => 'primary',
            'CLOSED'    => 'success',
        ];
        return $badges[$this->status];
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDate();
    }

    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->toFormattedTime();
    }
}
