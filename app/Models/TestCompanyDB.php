<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class TestCompanyDB extends Model
{
    protected $table = 'testCompanyDBmodified';
    protected $primaryKey = 'companyId';
    protected $fillable = [
        'companyName',
        'companyRegistrationNumber',
        'companyFoundationDate',
        'country',
        'zipCode',
        'city',
        'streetAddress',
        'latitude',
        'longitude',
        'companyOwner',
        'employees',
        'activity',
        'active',
        'email',
        'password',
        'companyRegistrationDate',
    ];
    protected $guarded = ['companyRegistrationDate'];
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'employees' => 'integer',
        'companyRegistrationDate' => 'datetime',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->companyRegistrationDate = now();
        });
    }

    /**
     * @param array $attributes
     * @return bool
     * @throws Throwable
     */
    public function createCompany(array $attributes)
    {
        return (new TestCompanyDB)->saveOrFail($attributes);
    }

    /**
     * @param array $companyID
     * @return TestCompanyDB[]|Collection|Model|null
     */
    public function findCompany(array $companyID)
    {
        $companies = $this->all();

        return $companies->find($companyID);
    }
}
