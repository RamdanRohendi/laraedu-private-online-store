<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;

class ProductsController extends Controller
{
    public function index()
    {
        return view('master.product.index');
    }

    public function getData()
    {
        $products = Product::all();

        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('foto', function ($product) {
                return '<img id="foto" class="" onerror="this.onerror=null;this.src=\''.asset('assets/img/default-profile.jpg').'\';" src="'.asset($product->foto).'" alt="foto-profile" width="75">';
            })
            ->addColumn('action', function($product){
                $btn = '
                    <div class="text-nowrap">
                        <a href="'.route('products.edit', $product->id).'" class="btn btn-warning">Edit</a>
                        <a href="'.route('products.destroy', $product->id).'" data-csrf="'.csrf_token().'" class="btn btn-danger btn-delete">Delete</a>
                    </div>
                ';

                return $btn;
            })
            ->rawColumns(['foto', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('master.product.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
            'nama' => 'required|min:3',
            'keterangan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $validatedData['user_id'] = Auth::user()->id;
        $product = Product::create($validatedData);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = $product->id."_Foto Sample".".".$file->getClientOriginalExtension();
            $path_file = $file->storeAs('public/uploads/'.Auth::user()->id.'/products', $nama_file);
            $product->foto = $nama_file;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('master.product.show')->with([
            'product' => $product,
        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('master.product.form')->with([
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3',
            'keterangan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $product = Product::find($id);

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]);

            $file = $request->file('foto');
            $nama_file = $product->id."_Foto Sample".".".$file->getClientOriginalExtension();
            $path_file = $file->storeAs('public/uploads/'.Auth::user()->id.'/products', $nama_file);

            $validatedData['foto'] = $nama_file;
        }

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->foto) {
            $path_storage = str_replace('/storage', 'storage', $product->foto);
            if (file_exists($path_storage)) {
                File::delete(public_path($path_storage));
            }
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully!',
        ]);
    }
}
