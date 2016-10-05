<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['text'];
    public $timestamps = false;
}