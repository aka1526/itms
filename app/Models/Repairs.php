<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairs extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='fa_uuid';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'repairs';
  protected $fillable = [
    'repair_uuid'
    , 'repair_docno'
    , 'repair_date'
    , 'repair_year'
    , 'repair_month'
    , 'repair_max'
    , 'fa_uuid'
    , 'fa_name'
    , 'repair_user'
    , 'repair_type'
    , 'repair_problem'
    , 'problem_img'
    , 'repair_cause'
    , 'repair_solution'
    , 'repair_checkby'
    , 'repair_costs'
    , 'repair_status'
    , 'repair_priority'
    , 'date_close'
    , 'create_by'
    , 'create_time'
    , 'modify_by'
    , 'modify_time'
      ];
}
