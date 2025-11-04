<?php

namespace App\Models;

use App\Services\CompteService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Compte extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['solde'];



   protected static function boot()
   {
       parent::boot();


       // Generate UUID for primary key
       static::creating(function ($model) {
           if (empty($model->id)) {
               $model->id = (string) Str::uuid();
           }
       });


             static::creating(function ($model) {
           if (empty($model->numero_compte)) {
               // Exemple : CPT-2025-XXXXX
               $model->numero_compte = 'CPT-' . date('Y') . '-' . strtoupper(Str::random(6));
           }
       });
   }
    public function getMetadonneesAttribute($value)
   {
       return json_decode($value, true) ?? [];
   }


   public function setMetadonneesAttribute($value)
   {
       $this->attributes['metadonnees'] = json_encode($value);
   }


  /** 🔗 Attribut calculé : solde actuel du compte */
   public function getSoldeAttribute() {
    
       return app(CompteService::class)->calculerSolde($this);
   }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'compte_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'numero_compte',
        'type_compte',
        'solde_initial',
        'titulaire',
        'client_id',
        'statut',
        'devise',
        'date_creation',
        'date_fermeture',
        'motifBlocage',
        'dateBlocage',
        'dateDeblocagePrevue',
        'motifDeblocage',
        'metadonnees',
        'dateDeblocage',

    ];

    protected $casts = [
        'metadonnees' => 'array',
        'solde_initial' => 'decimal:2',
        'date_creation' => 'datetime',
        'date_fermeture' => 'datetime',
        'dateBlocage' => 'datetime',
        'dateDeblocagePrevue' => 'datetime',
        'dateDeblocage' => 'datetime',

    ];

  

    
}
