<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use SiteHelpers;
use Crypt;
use URL;
use Session;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $jobs = Job::where('job_title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $jobs = Job::paginate($paginate_count);
        }
        
        return view('admin.jobs.index', compact('jobs'));
    }

    public function getForm($job_id='', Request $request)
    {
        if($job_id) {
            $job = Job::find($job_id);
        }else{
            $job = $this->getColumnTable('jobs');
        }
        return view('admin.jobs.form', compact('job'));
    }

    public function savejob(Request $request)
    {
        // echo '<pre>';print_r($_POST);exit;
        $job_id = $request->input('job_id');

        $validation_rules = ['job_title' => 'required|string'];

        $validator = Validator::make($request->all(),$validation_rules);

        // Stop if validation fails
        if ($validator->fails()) {
            return $this->return_output('error', 'error', $validator, 'back', '422');
        }

        if ($job_id) {
            $job = Job::find($job_id);
            $success_message = 'job updated successfully';
        } else {
            $job = new Job();
            $success_message = 'job added successfully';

            //create slug only while add
            $slug = $request->input('job_title');
            $slug = str_slug($slug, '-');

            $results = DB::select(DB::raw("SELECT count(*) as total from jobs where job_slug REGEXP '^{$slug}(-[0-9]+)?$' "));

            $finalSlug = ($results['0']->total > 0) ? "{$slug}-{$results['0']->total}" : $slug;
            $job->job_slug = $finalSlug;
        }

        $job->job_title = $request->input('job_title');
        $job->job_link = $request->input('job_link');
        $job->description = $request->input('description');
        $job->is_active = $request->input('is_active');
        
        if (Input::hasFile('job_image') && Input::has('job_image_base64')) {
            //delete old file
            $old_image = $request->input('old_job_image');
            if (Storage::exists($old_image)) {
                Storage::delete($old_image);
            }

            //get filename
            $file_name   = $request->file('job_image')->getClientOriginalName();

            // returns Intervention\Image\Image
            $image_make = Image::make($request->input('job_image_base64'))->encode('jpg');

            // create path
            $path = "jobs";
            
            //check if the file name is already exists
            $new_file_name = SiteHelpers::checkFileName($path, $file_name);

            //save the image using storage
            Storage::put($path."/".$new_file_name, $image_make->__toString(), 'public');

            $job->job_image = $path."/".$new_file_name;
            
        }

        $job->save();

        return $this->return_output('flash', 'success', $success_message, 'admin/job', '200');
    }

    public function deletejob($job_id)
    {
        Job::destroy($job_id);
        return $this->return_output('flash', 'success', 'job deleted successfully', 'admin/job', '200');
    }

}
