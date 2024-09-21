<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The books that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'student_book')   ->withPivot('created_at', 'expiry_date');
    }
 
    /**
     * Get the Faculties that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get the Fine associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Fine()
    {
        return $this->hasOne(Fine::class);
    }
}
