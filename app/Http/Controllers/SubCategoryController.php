<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller

{
    public function index()
    {
        $categories = SubCategory::get();
        $cats = Category::get();
        return view('/admin/subCategories', compact('categories','cats'));
    }


    public function store(Request $request )
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('subCategories/images', $request->file('image')->getClientOriginalName());
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
    
        $category = SubCategory::create([
            'name' => $validatedData['name'],
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);
    
        if ($category) {
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
                'max:100',
            ],
            'image' => 'image|max:2048',
        ], [
            'name.required' => 'The  name field is required.',
            'name.max' => 'The  name may not be greater than :max characters.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ]);
    
        $category = SubCategory::findOrFail($sr);
        $imagePath = $category->image;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('subCategories/images', $request->file('image')->getClientOriginalName());
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
    
        $category->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
        ]);
    
        if ($category) {
            toastr()->success('Data updated successfully');
            return back();
        } else {
            toastr()->error('There is a problem right now, please try again');
            return back();
        }
    }
    

    public function delete(Request $request, int $sr)
    {

        SubCategory::findOrFail($sr)->delete();
        toastr()->success('Data deletes successfully');
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

    // Assuming Laravel controller
public function showSubcategories(Request $request)
{
    $category_id = $request->input('category_id');
    
    $subcategories = Subcategory::where('category_id', $category_id)->get();

    return response()->json($subcategories);
}

}
