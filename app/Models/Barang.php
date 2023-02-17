<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['file_gambar','file_nama','harga_beli','harga_jual','stok'];

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            if(empty($model->uuid)){
                $model->uuid = Str::uuid();
            }
        });
    }
}
