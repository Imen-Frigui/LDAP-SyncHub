<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LdapUser extends Model
{
    use HasFactory;

    protected $dn = 'uid';

    // Define attributes for this model
    protected $fillable = [
        'cn',
        'sn',
        'mail',
        'userPassword',
    ];

    // Define the object classes for this model
    public function objectClasses()
    {
        return ['inetOrgPerson'];
    }
}
