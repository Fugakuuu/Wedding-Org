<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'Admin';
    protected $primaryKey = 'Admin_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'Dekripsi_adm',
        'Alamat_adm',
        'Telepon_adm',
        'Email_adm',
    ];

    protected $hidden = ['password'];

    public function getRememberTokenName()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        //
    }
}
