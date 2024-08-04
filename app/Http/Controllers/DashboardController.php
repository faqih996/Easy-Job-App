<?php

namespace App\Http\Controllers;

use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function my_applications(){

        // get the current authenticated user
        $user = Auth::user();

        // get the current authenticated user's job applications using Eloquent ORM and pagination
        $my_applications = JobCandidate::where('candidate_id', $user->id)->orderBy('id')->paginate();

        // return the view with the paginated job applications
        return view('dashboard.my_applications', compact('my_applications'));

    }

    public function my_application_details(JobCandidate $jobCandidate){

        // get the current authenticated user
        $user = Auth::user();

        // check if the current user is the owner of the job application
        if($jobCandidate->candidate_id != $user->id){
            abort(403);
        }

        // get the job details and the company details
        return view('dashboard.my_application_details', compact('jobCandidate'));
    }
}