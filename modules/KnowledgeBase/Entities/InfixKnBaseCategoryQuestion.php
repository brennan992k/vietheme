<?php

namespace Modules\KnowledgeBase\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixKnBaseCategoryQuestion extends Model
{
    protected $table = 'infix_category_question';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function quentionCategory()
    {
        return $this->belongsTo(InfixKnowledgeBaseCategory::class, 'category_id');
    }
    
    public function secondQuestion()
    {
        return $this->hasMany(InfixKnowledgeBase::class, 'question_id', 'id');
    }

    public function scopeFindByCategoryId($query, $category_id)
    {
        return $query->whereHas('quentionCategory', function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        });
    }
}
