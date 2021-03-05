<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
    protected $table    = 'paragraphs';
    protected $hidden   = ['created_at', 'updated_at'];
    protected $fillable = ['event_id', 'content', 'title'];


}
