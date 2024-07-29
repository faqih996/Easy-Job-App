<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Get current authenticated user
        $user = Auth::user();

        // Get my company from employer_id field in user table
        $my_company = Company::where('employer_id', $user->id)->first();

        // If my company exists, get all its jobs
        if ($my_company) {
            // Get all jobs
            $company_jobs = CompanyJob::with(['Category'])->where('company_id', $my_company->id)->paginate(10);
        } else {
            // If my company does not exist, return an empty collection
            $company_jobs = collect();
        }

        // Return view with company jobs
        return view('admin.company_jobs.index', compact('company_jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyJob $companyJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyJob $companyJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyJob $companyJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyJob $companyJob)
    {
        //
    }
}