<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periods extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='periods_name';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'periods';
  protected $fillable = [
        'periods-uuid'
        , 'periods_name'
        , 'periods_interval'
        , 'create_by'
        , 'create_time'
        , 'modify_by'
        , 'modify_time'
      ];
}
