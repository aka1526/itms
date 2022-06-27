<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmresults extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='ac_uuid';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'pmresults';
  protected $fillable = [
            'ac_uuid'
            , 'ac_year'
            , 'ac_month'
            , 'ac_date'
            , 'plan_uuid'
            , 'fa_uuid'
            , 'fa_name'
            , 'ac_item'
            , 'ac_desc'
            , 'ac_method'
            , 'ac_std'
            , 'ac_result'
            , 'create_by'
            , 'create_time'
            , 'modify_by'
            , 'modify_time'
      ];
}
