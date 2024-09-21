<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

   /**
    * Get all of the Students for the Faculty
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function Students()
   {
       return $this->hasMany(Student::class);
   }
}
