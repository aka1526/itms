<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixasset extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

  protected $primaryKey ='fa_uuid ';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = false;
  public $table = 'fixasset';
  protected $fillable = [
         'fa_uuid'
         ,'fa_name'
         ,'fa_sec'
         ,'fa_type'
         ,'fa_user'
         ,'fa_tel'
         ,'fa_email'
         ,'fa_status'
         ,'fa_ip'
         ,'fa_vender'
        ,'create_by'
        ,'create_time'
        ,'modify_by'
        ,'modify_time'
      ];
}
