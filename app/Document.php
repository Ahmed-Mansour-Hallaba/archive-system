<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $table = 'documents';
    protected $fillable = [
        'number', 'subject', 'sender', 'reciever', 'date', 'copy_to', 'image', 'user_type', 'logged_user_id',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class, "document_id");
    }
    public function master(){
        return $this->belongsTo(Master::class,'logged_user_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'logged_user_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'logged_user_id');
    }
}
