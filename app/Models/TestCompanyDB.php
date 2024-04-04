<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class TestCompanyDB extends Model
{
    public $timestamps = false;
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
        'created_at',
    ];
    protected $guarded = ['created_at'];
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'employees' => 'integer',
        'created_at' => 'datetime',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
        });
    }

    /**
     * @param array $attributes
     * @return bool
     * @throws Throwable
     */
    public static function createCompany(array $attributes)
    {
        return TestCompanyDB::create($attributes);
    }


    /**
     * @param $companyId
     * @return mixed
     * @throws Exception
     */
    public static function findCompany($companyId)
    {
        try {
            return TestCompanyDB::findOrFail($companyId);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error('Error occurred while finding company: ' . $e->getMessage());
            throw $e;
        }
    }
}
