<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GitHubRepository extends Model
{
    use HasFactory;

    protected $table = 'repositories';

    protected $fillable = [
        'name',
        'html_url',
        'description',
        'owner',
        'stars',
        'user_id'
    ];
}
