<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller

{
    public function index()
    {
        $categories = Category::get();
        return view('/admin/categories', compact('categories'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image',
        ], [
            'name.required' => 'The  name field is required.',
            'name.max' => 'The  name may not be greater than :max characters.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('categories/images', $request->file('image')->getClientOriginalName());
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
    
        $categry = Category::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
        ]);
    
        if ($categry) {
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
            'name' => [
                'required',
                Rule::unique('categories')->ignore($sr),
                'max:100',
            ],
            'image' => 'image|max:2048',
        ], [
            'name.required' => 'The  name field is required.',
            'name.unique' => 'The  name has already been taken.',
            'name.max' => 'The name may not be greater than :max characters.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ]);
    
        $categry = Category::findOrFail($sr);
        $imagePath = $categry->image;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('Categories/images', $request->file('image')->getClientOriginalName());
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
    
        $categry->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
        ]);
    
        if ($categry) {
            toastr()->success('Data updated successfully');
            return back();
        } else {
            toastr()->error('There is a problem right now, please try again');
            return back();
        }
    }
    

    public function delete(Request $request, int $sr)
    {

        Category::findOrFail($sr)->delete();
        toastr()->success('Data Deleted successfully');
        return back();
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
