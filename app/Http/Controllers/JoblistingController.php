<?php

namespace App\Http\Controllers;

use App\Models\Joblisting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Cloudinary\Api\Upload\UploadApi;

class JoblistingController extends Controller
{
    //show all jobs with pagination
    public function index() {
        return view('jobslisting.index', [
            'joblistings' => Joblisting::latest()->filter(request(['tag', 'search']))->paginate(10)
        ]);
    }

    //show single job
    public function show(Joblisting $joblisting){
        return view('jobslisting.show', [
            'joblisting'=> $joblisting
        ]);
    }


    //show create job
    public function create(){
        return view('jobslisting.create', [
            /* 'jobdata'=> $jobdata */
        ]);
    }

    //store job
    public function store(){
        $formData = request()->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if (request()->hasFile('logo')){
            //upload imgs to cloudinary
            $logoRealPath = request()->file('logo')->getRealPath();
            $uploadResponse = (new UploadApi())->upload($logoRealPath);

            /* dd($uploadResponse); */

            // Store the URL (or public ID) of the uploaded image in formData
            $formData['logo'] = $uploadResponse['secure_url'];
        }

        $formData['user_id'] = auth()->id();

        Joblisting::create($formData);


        return redirect('/')->with('message', 'The job has been posted successfully!');

    }

    public function edit(Joblisting $joblisting){
        return view('jobslisting.edit', ['joblisting' => $joblisting]);
    }

    public function update(Request $request, Joblisting $joblisting){
        // Make sure logged in user is owner
        if($joblisting->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formData = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if (request()->hasFile('logo')){
            //upload imgs to cloudinary
            $logoRealPath = request()->file('logo')->getRealPath();
            $uploadResponse = (new UploadApi())->upload($logoRealPath);

            /* dd($uploadResponse); */

            // Store the URL (or public ID) of the uploaded image in formData
            $formData['logo'] = $uploadResponse['secure_url'];
        }

        $joblisting->update($formData);
        return redirect()->route('joblisting.show', $joblisting->id)->with('message', 'The job has been edited successfully!');

    }

    public function delete(Request $request, Joblisting $joblisting){
        // Make sure logged in user is owner
        if($joblisting->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $joblisting->delete();
        return redirect('/')->with('message', 'The job has been deleted successfully!');
    }

    public function manage() {
        // Pagina los resultados
        $joblistings = auth()->user()->joblistings()->paginate(10);

        return view('jobslisting.manage', ['joblistings' => $joblistings]);
    }

}
