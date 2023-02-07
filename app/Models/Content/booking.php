<?php

namespace App\Models\Content;

use App\Domains\Auth\Models\User;
use App\Models\Content\Carton;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookings';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartons()
    {
        return $this->belongsTo(Carton::class, 'carton_id', 'id');
    }
}
