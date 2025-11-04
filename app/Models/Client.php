<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
     public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'uuid'; // Définir 'uuid' comme clé primaire

    public static function boot()
    {
        parent::boot();

        // Generate UUID for primary key
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function authenticable()
    {
        return $this->morphOne(User::class, 'authenticatable');             
    }       

    public function compteas()
    {
        return $this->hasMany(Compte::class, 'client_id');    }

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'adresse',
        'telephone',
        'cni',
    ];

}
