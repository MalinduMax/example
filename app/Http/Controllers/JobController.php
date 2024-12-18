<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', null);

        // Start the query
        $query = Job::with('employer')->latest();

        // If there's a search term, modify the query
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Paginate the results
        $jobs = $query->simplePaginate(10);

        return view('jobs.index', compact('jobs', 'search'));
    }
    public function create()
    {

        return view('jobs.create');

    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $file = $request->hasFile('image');
        if($file){
            $newFile = $request->file('image');
            $filePath = $newFile->store('public/storage');
            Job::create([
                'title' => $request->title,
                'salary' => $request->salary,
                'src' => $filePath,
                'employer_id' => 1
            ]);
        }

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {

        Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job, Request $request)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);
        //authorize

        if ($request->hasFile('image')) {
            $destination = 'public/storage'. $job->src;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $name = $file->store('public/storage');
            $job->update([
                'title' => request('title'),
                'salary' => request('salary'),
                'src' => $name,
            ]);
        }




        return redirect('/jobs');
    }

    public function delete(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }

}



