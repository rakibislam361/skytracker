<?php

namespace App\Models\Content;

use App\Domains\Auth\Models\User;
use App\Models\Content\Carton;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes, HasRoles;

    public const TYPE_ADMIN = 'booking';
    public const TYPE_USER = 'user';

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
    public function itemTrackStatus()
    {
        return $this->hasMany(ItemTracking::class, 'item_number', 'id');
    }
}
