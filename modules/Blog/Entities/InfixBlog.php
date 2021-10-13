<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixBlog extends Model
{
    protected $table = 'infix_blog';
    protected $primaryKey = 'id';
    protected $fillable = [];
}
