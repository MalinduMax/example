<h2>
    {{ $job->title }}
</h2>
<p>
    Congrats! your job is posted on our website.
</p>
<p>
    <a href="{{ url('/jobs', $job->id) }}">View Your Job Listing</a>
</p>
