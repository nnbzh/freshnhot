<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table    = 'events';
    protected $hidden   = ['created_at', 'updated_at'];
    protected $fillable = ['event_id', 'content', 'title', 'img_src'];

    public function paragraphs() {
        return $this->hasMany(Paragraph::class, 'event_id', 'id');
    }
}
