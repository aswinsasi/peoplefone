<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isImpersonating()
    {
        return session()->has('admin_impersonator_id');
    }
}
