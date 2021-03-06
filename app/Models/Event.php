<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table    = 'events';
    protected $hidden   = ['created_at', 'updated_at'];
    protected $fillable = ['title', 'description','img_src','type'];

    public function paragraphs() {
        return $this->hasMany(Paragraph::class, 'event_id', 'id');
    }
}
