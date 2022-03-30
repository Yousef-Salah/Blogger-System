<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'total_commetns',
        'total_likes',
        'total_dislikes',
        'tags',
        'image'
    ];

    public static function booted()
    {
        static::addGlobalScope('user_id', function (Builder $builder) {
            $builder->where('user_id', '=', Auth::user()->id);
        });
    }

    public function getsummaryAttribute() 
    {
        return Str::words(html_entity_decode(strip_tags($this->text)), 10);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function tags()
    {
        return $this->HasMany(Tag::class, 'blog_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function interactionStatus($userID)
    {
        $data = DB::table('interactions')->where('user_id', '=', $userID)->where('blog_id', '=', $this->id)->first();

        if($data){
            return $data->interaction;
        } 

        return false;        
    }
}
