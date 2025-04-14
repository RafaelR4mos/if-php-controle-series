<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id_task';

    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'due_date',
        'is_completed',
        'arquivo',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
