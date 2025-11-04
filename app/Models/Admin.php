<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $incrementing = false;
    
   protected $keyType = 'string';


       /** 🔗 Relation polymorphe inverse */
   public function user()
   {
       return $this->morphOne(User::class, 'authenticatable');
   }


   protected $fillable = [
       'nom',
       'prenom',
       'telephone'
   ];



}
