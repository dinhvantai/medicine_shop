<?php

namespace App\Eloquent\Relations;

use App\Eloquent\User;
use App\Eloquent\Medicine;
use App\Eloquent\Comment;

trait CommentRelation
{
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function getChildrenComment()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
