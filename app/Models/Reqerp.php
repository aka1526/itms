<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reqerp extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='req_no';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'reqerp';
  protected $fillable = [
        'req_unid',
        'req_no',
        'req_date',
        'req_fa',
        'req_name',
        'req_title',
        'req_desc',
        'req_vote1_name',
        'req_vote2_name',
        'req_vote3_name',
        'req_vote4_name',
        'req_vote1_stat',
        'req_vote2_stat',
        'req_vote3_stat',
        'req_vote4_stat',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
      ];
}
