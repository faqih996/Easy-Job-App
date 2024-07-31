<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyJob;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){

        $categories = Category::all();
        $jobs = CompanyJob::with(['company', 'category'])->latest()->take(6)->get();

        return view('front.index', compact('categories', 'jobs'));
    }

    public function details(CompanyJob $companyJob){

        $jobs = CompanyJob::with(['category','company'])
        ->where('id', '!=', $companyJob->id)
        ->inRandomOrder()
        ->take(4)
        ->get();


        return view('front.details', compact('companyJob', 'jobs'));
    }
}