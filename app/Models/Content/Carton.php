<?php

namespace App\Models\Content;

use App\Domains\Auth\Models\User;
use App\Models\Content\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carton extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cartons';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
}
