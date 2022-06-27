<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklists extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='ch_uuid';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'checklists';
  protected $fillable = [
        'ch_uuid'
        , 'ch_item'
        , 'ch_desc'
        , 'ch_method'
        , 'ch_std'
        , 'create_by'
        , 'create_time'
        , 'modify_by'
        , 'modify_time'
      ];
}
