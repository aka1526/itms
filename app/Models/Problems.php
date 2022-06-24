<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problems extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='problem_uuid';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'problems';
  protected $fillable = [
    'problem_uuid'
    , 'problem_code'
    , 'problem_name'
    , 'create_by'
    , 'create_time'
    , 'modify_by'
    , 'modify_time'
      ];
}
