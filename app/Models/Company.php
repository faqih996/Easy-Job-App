<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'slug',
        'about',
        'employer_id',
    ];

    //relations between models user and company
    public function employer(){
        return $this->belongsTo(User::class, 'employer_id');
    }

    // relations between models company and company_job
    public function jobs(){
        return $this->hasMany(CompanyJob::class);
    }
}