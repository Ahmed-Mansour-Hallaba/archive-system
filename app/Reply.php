<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';
    protected $fillable = [
        'number', 'subject', 'sender', 'reciever', 'date', 'copy_to', 'image', 'user_type', 'logged_user_id', 'document_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, "document_id");
    }
}
