<?php

namespace App;

use App\Branch;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{

    protected $table = "masters";

    protected $fillable = [
        'name',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function departments()
    {
        return $this->hasManyThrough(Department::class, Branch::class);
    }
}
