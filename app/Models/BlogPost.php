<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BlogPost extends Model
{
    use HasFactory;
    /*
    protected $table = 'Blog';
    protected $primaryKey = "blog_id";
    */
    protected $fillable = [
        'title',
        'title_fr',
        'body',
        'body_fr',
        'user_id',
        'categories_id'
    ];
    public function blogHasUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function blogHasCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'categories_id');
    }
}
