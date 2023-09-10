<?php
namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request) {

        // dd($request->all());
        $request->validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            'image' => 'image'
        ]);

        
        $newProduct = new Product();
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage("game.png");
        $newProduct->save();
        
        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId().".".$request->file('image')->extension();
            //The public disk stores files in storage/app/public folder by default. 
            //The put method will store our product images over the public disk.
            
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
                $newProduct->setImage($imageName);
                $newProduct->save();
            }
            // To make these files accessible from the web, we must create a “symbolic link” from public/storage
            // to storage/app/public . Then, in the Terminal, go to the project directory, and execute the following:
            // php artisan storage:link     
        return back();

    }
}
