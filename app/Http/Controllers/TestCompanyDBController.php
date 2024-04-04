<?php

namespace App\Http\Controllers;

use App\Models\TestCompanyDB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestCompanyDBController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
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
            'password' => 'required|string|min:6',
        ]);

        $company = (new TestCompanyDB)->createCompany($request->all());

        return response()->json($company, 201);
    }

    /**
     * @param $companyId
     * @return JsonResponse
     */
    public function show($companyId)
    {
        $companies = (new TestCompanyDB)->findCompany(explode(',', $companyId));

        return response()->json($companies);
    }

    /**
     * @param Request $request
     * @param $companyId
     * @return JsonResponse
     */
    public function update(Request $request, $companyId)
    {
        $request->validate([
            'companyName' => 'sometimes|required|string|unique:testCompanyDBmodified,companyName,'
                . $companyId .
                ',companyId',
            'companyRegistrationNumber' =>
                'sometimes|required|string|unique:testCompanyDBmodified,companyRegistrationNumber,'
                . $companyId .
                ',companyId',
            'companyFoundationDate' => 'sometimes|required|date',
            'country' => 'sometimes|required|string',
            'zipCode' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'streetAddress' => 'sometimes|required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'companyOwner' => 'nullable|string',
            'employees' => 'nullable|integer|min:0',
            'activity' => 'nullable|string',
            'active' => 'nullable|string|in:yes,no',
            'email' => 'nullable|email',
            'password' => 'sometimes|required|string|min:6',
        ]);

        $company = (new TestCompanyDB)->findCompany($companyId);

        $company->update($request->all());

        return response()->json($company, 201);
    }

    public function destroy($companyId)
    {
        $company = (new TestCompanyDB)->findCompany($companyId);

        $company->delete();

        return response()->json(null, 204);
    }
}
