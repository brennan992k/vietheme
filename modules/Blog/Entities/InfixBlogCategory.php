<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixBlogCategory extends Model
{
    protected $table = 'infix_blog_category';
    protected $primaryKey = 'id';
    protected $fillable = [];
}
