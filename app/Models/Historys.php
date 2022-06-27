<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historys extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='uuid';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'historys';
  protected $fillable = [
            'uuid'
            , 'ref_docno'
            , 'ref_uuid'
            , 'ref_date'
            , 'repair_year'
            , 'repair_month'
            , 'fa_uuid'
            , 'fa_name'
            , 'fa_user'
            , 'checkby'
            , 'data_type'
            , 'data_problem'
            , 'data_cause'
            , 'data_solution'
            , 'data_costs'
            , 'create_by'
            , 'create_time'
            , 'modify_by'
            , 'modify_time'
      ];
}
