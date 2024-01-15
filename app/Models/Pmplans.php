<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmplans extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='pm_uuid';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'pmplans';
  protected $fillable = [
        'pm_uuid'
        , 'pm_date'
        , 'pm_year'
        , 'pm_month'
        , 'fa_uuid'
        , 'pm_sec'
        , 'pm_act_date'
        , 'pm_status'
        , 'pm_by'
        , 'create_by'
        , 'create_time'
        , 'modify_by'
        , 'modify_time'
      ];
}
