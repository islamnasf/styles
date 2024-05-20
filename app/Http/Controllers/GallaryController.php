<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class GallaryController extends Controller


{
    public function index()
    {
        $galleries = Gallery::get();
        $subcats = SubCategory::get();
        $cats = Category::get();
        return view('/admin/gallery', compact('galleries','cats','subcats'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pdf' => 'file|mimes:pdf',
            'sub_category_id'=>'required',
            'video' => 'file',
            'image' => 'image',
        ], [
            'sub_category_id.required' => 'The subCategory Is Requires .',
            'pdf.file' => 'The file must be a PDF.',
            'video.file' => 'The file must be a video ',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ]);
    
        $imagePath = null;
        $pdfPath = null;
        $videoPath = null;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('subCategories/0/images', $request->file('image')->getClientOriginalName());
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
       
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->move('subCategories/videos', $request->file('video')->getClientOriginalName());
            if (!$videoPath) {
                return back()->withInput()->withErrors(['video' => 'An error occurred while uploading the video.']);
            }
        }
    
        $gallery = Gallery::create([
            'sub_category_id' => $request->sub_category_id,
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'video' => $videoPath,        
        ]);
        if ($request->file('pdf')) {
            $pdf = $request->pdf;
            $filename1 = $pdf->getClientOriginalName();
            $request->pdf->storeAs('public/pdf', $filename1);
            $gallery->update([
                'pdf' => $filename1,
            ]);
        }
    
        if ($gallery) {
            toastr()->success('Data saved successfully');
            return back();
        } else {
            toastr()->error('There is a problem right now, please try again');
            return back();
        }
    }
    
    
    public function update(Request $request, int $sr)
    {
        $validatedData = $request->validate([
            'image' => 'image',
            'pdf' => 'file|mimes:pdf',
            'video' => 'file',
        ], [
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
            'pdf.file' => 'The file must be a PDF.',
            'video.file' => 'The file must be a video ',
        ]);
    
        $gallery = Gallery::findOrFail($sr);
        $imagePath = $gallery->image;
        $pdfPath = $gallery->pdf;
        $videoPath = $gallery->video;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('subCategories/0/images', $request->file('image')->getClientOriginalName());
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->storeAs('/subCategories/pdfs', $request->file('pdf')->getClientOriginalName());
            if (!$pdfPath) {
                return back()->withInput()->withErrors(['pdf' => 'An error occurred while uploading the PDF.']);
            }
        }
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->move('subCategories/videos', $request->file('video')->getClientOriginalName());
            if (!$videoPath) {
                return back()->withInput()->withErrors(['video' => 'An error occurred while uploading the video.']);
            }
        }
    
        $gallery->update([
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'video' => $videoPath,
        ]);
    
        if ($gallery) {
            toastr()->success('Data updated successfully');
            return back();
        } else {
            toastr()->error('There is a problem right now, please try again');
            return back();
        }
    }
    public function delete(Request $request, int $sr)
    {

        Gallery::findOrFail($sr)->delete();
        toastr()->success('Data deletes successfully');
        return back();
    }
    public function download($fileName)
    {
        return response()->download(storage_path('app/public/pdf/' . $fileName));
    }
    public function downloadVideo($fileName)
    {
        return response()->download(public_path('subCategories/videos/' . $fileName));
    }


    // public function toggle(Service $service)
    // {
    //     $service->active = !$service->active;
    //     $service->save();

    //     if ($service->active == 1 ) {
    //         toastr()->success('تم تفعيل الخدمة بنجاح');
    //     } else {
    //         toastr()->success('تم إيقاف الخدمة بنجاح');
    //     }
    //     return back();
    // }
}
