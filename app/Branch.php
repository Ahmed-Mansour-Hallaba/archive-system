<?php

namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branches";

    protected $fillable = [
        'name', 'master_id',
    ];
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
