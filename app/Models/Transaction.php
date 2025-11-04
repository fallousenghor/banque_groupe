<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class Transaction extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        // Generate UUID for primary key
          static ::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });

        static::creating(function ($model) {
            if (empty($model->reference)) {
                $model->reference = 'TXN-' . date('Y') . '-' . strtoupper(Str::random(6));
            }
           
        });
      
    }

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'compte_id');
    }
     

    protected $fillable = [
        'compte_id',
        'montant',
        'description',
        'date_transaction',
        'type_transaction',
        
    ];
}
