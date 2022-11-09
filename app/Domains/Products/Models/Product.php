<?php

namespace App\Domains\Products\Models;

use App\Domains\Auth\Models\User;
use App\Domains\Products\Models\Warehouse;
use App\Domains\Products\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'products';

  public $primaryKey = 'id';

  public $foreignId = 'warehouse_id';

  public $timestamps = true;

  protected $guarded = [];


  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function warehouse()
  {
    return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
  }
  public function status()
  {
    return $this->belongsTo(Status::class, 'status_id', 'id');
  }
}
