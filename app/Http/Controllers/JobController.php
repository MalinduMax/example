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
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index', ['jobs' => $jobs]);
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
            'salary' => ['required']
        ]);

        $job->title = $request->input('title');
        $job->salary = $request->input('salary');
        $job->id = 1;
        if($file = $request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = time().'.'.$extension;
            $file->move('public/storage',$name);
            $job->src=$name;
        }
        $job->src = $request->input('src');
        
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
