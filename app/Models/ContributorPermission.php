<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContributorPermission extends Model
{
    const Permissions = ['r', 'w'];

     protected $table ="contributor_permissions";
     protected $fillable=["permission","contributor_id","capsule_id","deleted_at"];
    use HasFactory;

    public function  contributor(){


        return $this->belongsTo(Contributor::class);
    }
    public function capsule(){
        return $this->belongsTo(Capsule::class); }
    }

