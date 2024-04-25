<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use App\Models\GallaryImage;
class ImageController extends Controller
{
    public function storeImage(Request $request)
    {
        $request->validate([
            'caption'=>'required|max:255',
            'category'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg,bmp'
        ],[
            'category.required'=>'Please select a category'
        ]);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image_name=rand(1000,9999).time().'.'.$file->getClientOriginalExtension();
            $thumbPath=public_path('user_images/thumb');
            

            $file->move(public_path('user_images'),$image_name);


        }
    

        GallaryImage::create([
            'user_id'=>auth()->id(),    
            'caption'=>$request->caption,
            'category'=>$request->category,
            'image'=>$image_name
        ]);
        
        return redirect()->route('home')->with('success', 'Image Successfully Uploaded.');
    }

    public function welcome() {
        $data = GallaryImage::all();

        return view('welcome', compact('data'));
    }

    public function detailImage(GallaryImage $image){
        return view("detail", compact("image"));
    }
    
    public function destroy(GallaryImage $image) {
        $image->delete();

        return redirect()->route('home');
    }

    public function personal(){
        $personal_image = GallaryImage::where("user_id", auth()->user()->id)->get();
        return view("personal", compact("personal_image"));
    }

    public function update(Request $request, GallaryImage $image) {
        $request->validate([
            'caption'=>'required|max:255',
            'category'=>'required',
        ],[
            'category.required'=>'Please select a category'
        ]);
        $image->update([  
            'caption'=>$request->caption,
            'category'=>$request->category,
        ]);

        return redirect()->route('home');
    }

    public function edit(GallaryImage $image) {

        return view('edit', compact('image'));
    }

    // Fungsi kustom untuk membatasi komentar
    public function truncateText($text, $limit = 20, $end = '...')
    {
        return Str::limit($text, $limit, $end);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
        
}

