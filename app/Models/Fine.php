<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;
    /**
     * Get the Student that owns the Fine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
}
