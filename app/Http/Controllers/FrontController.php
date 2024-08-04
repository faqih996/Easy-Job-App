<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplyJobRequest;
use App\Models\Category;
use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function apply(CompanyJob $companyJob){
        return view('front.apply', compact('companyJob'));
    }

    public function apply_store(StoreApplyJobRequest $request, CompanyJob $companyJob){
        $user = Auth::user();

        $hasApplied = JobCandidate::where('company_job_id', $companyJob->id)
        ->where('candidate_id', $user->id)->first();
        if ($hasApplied){
            return redirect()->back()->withErrors(['applied' => 'Anda sudah mengajukan pada pekerjaan ini.']);
        }

        DB::transaction(function() use ($request, $user, $companyJob ){
            $validated = $request->validated();

            if($request->hasFile('resume')){
                $resumePath = $request->file('resume')->store('resumes/' . date('Y/m/d'), 'public');
                $validated['resume'] = $resumePath;
            }

            $validated['candidate_id'] = $user->id;
            $validated['is_hired'] = false;
            $validated['company_job_id'] = $companyJob->id;

            $newData = JobCandidate::create($validated);

        });

        return redirect()->route('front.apply.success')->with('success', 'Anda telah mengajukan pada pekerjaan ini. Silahkan tunggu balasan dari perusahaan.');

    }

    public function success_apply(){
        return view('front.success_apply');
    }

    public function search(Request $request){

        $request->validate([
            'keyword' => ['required', 'string', 'max:255']
        ]);

        $keyword = $request->keyword;

        $jobs = CompanyJob::with(['company', 'category'])
        ->where('name', 'like', '%' . $keyword . '%')->paginate(1);

        return view('front.search', compact('jobs', 'keyword'));

    }

    public function category(Category $category){
        return view('front.category', compact('category'));
    }

}