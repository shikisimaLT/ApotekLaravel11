<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->orderBy('id', 'DESC')->get();
        return view('admin.products.index',[
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.products.create',[
            'categories' => $categories,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'about' => 'required|string',
            'photo' => 'required|image|mimes:png,jpg,svg',
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('photo')){
                $photoPath = $request->file('photo')->store('Product_photos', 'public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);

            $newProduct = Product::create($validated);

            DB::commit();
            
            return redirect()->route('admin.products.index');
        }catch(\Exception $e){
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System Error! ' . $e->getMessage()]
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'about' => 'required|string',
            'photo' => 'sometimes|image|mimes:png,jpg,svg',
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('photo')){
                $photoPath = $request->file('photo')->store('Product_photos', 'public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);

            $product->update($validated);

            DB::commit();
            
            return redirect()->route('admin.products.index');
        }catch(\Exception $e){
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System Error! ' . $e->getMessage()]
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
        try{
            $product->delete();
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System Error! ' . $e->getMessage()]
            ]);
            throw $error;
        };
    }
}
