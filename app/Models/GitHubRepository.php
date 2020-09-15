<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GitHubRepository extends Model
{
    use HasFactory;

    protected $table = 'repositories';
    /*
    *name, html_url, description, owner.login, stargazers_count
    */
    protected $fillable = [
        'name',
        'html_url',
        'description',
        'owner',
        'stars',
    ];
}
