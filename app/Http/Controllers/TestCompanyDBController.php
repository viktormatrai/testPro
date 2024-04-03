<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestCompanyDBController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'companyName' => 'required|string|unique:testCompanyDBmodified,companyName',
            'companyRegistrationNumber' => 'required|string|unique:testCompanyDBmodified,companyRegistrationNumber',
            'companyFoundationDate' => 'required|date',
            'country' => 'required|string',
            'zipCode' => 'required|string',
            'city' => 'required|string',
            'streetAddress' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'companyOwner' => 'nullable|string',
            'employees' => 'nullable|integer|min:0',
            'activity' => 'nullable|string',
            'active' => 'nullable|string|in:yes,no',
            'email' => 'nullable|email',
            'password' => 'required|string|min:6',       ]);

        $company = TestCompanyDB::create($request->all());

        return response()->json($company, 201);
    }
}
