<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'category',
        'file_path',
        'status',
        'user_id',
        'supervisor_id',
        'abstract',
        'keywords',
        'submission_date',
        'approval_date',
        'rejection_reason',
        'approved_by',
        'is_open_source',
        'is_public'
    ];
}
