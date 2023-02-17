<?php

namespace App\Http\Controllers;

Use App\Models\Barang;
use Illuminate\Http\Request;
use Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::select('*')->get();

        if ($data->isEmpty()){
            return response()->json([
                'status' => 200,
                'message' => 'Data Not Found',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data Found',
                'data' => $data
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png|max:100',
            'file_nama' => 'required|string|unique:barang',
            'harga_beli' => 'Integer|min:0',
            'harga_jual' => 'Integer|min:0',
            'stok' => 'Integer|min:0|max:40000'
        ],[
            'file.required' => 'Foto Produk is Required',
            'file.mimes' => 'Foto Produk Must be JPG or PNG format',
            'file.max' => 'Foto Produk Max 100kb',
            'file_nama.required' => 'Nama Produk is Required',
            'file_nama.string' => 'Nama Produk Must be String',
            'file_nama.unique' => 'Nama Produk has been taken', 
            'harga_beli.Integer' => 'Harga Beli must be Integer',
            'harga_beli.min' => 'Harga Beli minLength 0',
            'harga_jual.Integer' => 'Harga Jual Must be Integer',
            'harga_jual.min' => 'Harga Jual minLength 0',
            'stok.Integer' => 'Stok must be Integer',
            'stok.min' => 'Stok minLength 0'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
             
        if ($file = $request->file('file')) {
            //store file into image folder
            $file->storeAs('public/image',strtotime("now").".".$request->file->extension());
            $file = strtotime("now").".".$request->file->extension(); 
 
            //store your file into database
            $barang = new Barang();
            $barang->file_gambar = $file;
            $barang->file_nama = $request->file_nama;
            $barang->harga_beli = $request->harga_beli;
            $barang->harga_jual = $request->harga_jual;
            $barang->stok = $request->stok;
            $barang->save();
              
            return response()->json([
                'status' => 200,
                'message' => 'Data Barang created successfully',
                'data' => $barang
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
