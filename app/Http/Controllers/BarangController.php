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
                'message' => 'Data Tidak Ditemukan',
                'data' => $data
            ], 200);
        } else {
            $newData = array();
            foreach($data as $d){
                $rows['uuid'] = $d->uuid;
                $rows['file'] = 'storage/image/'.$d->file_gambar;
                $rows['file_nama'] = $d->file_nama;
                $rows['harga_beli'] = $d->harga_beli;
                $rows['harga_jual'] = $d->harga_jual;
                $rows['stok'] = $d->stok;
                $rows['action'] = '<button class="btn btn-outline-info" onclick="showProject('.$d->uuid.'><i class="fa fa-eye" aria-hidden="true"></i></button><button class="btn btn-outline-success" onclick="editProject('.$d->uuid.'><i class="fa fa-pencil" aria-hidden="true"></i></button><button class="btn btn-outline-danger" onclick="destroyProject('.$d->uuid.'><i class="fa fa-trash" aria-hidden="true"></i></button>';

                $newData[] = $rows;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Tersedia',
                'data' => $newData
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
            'stok' => 'Integer|min:0'
        ],[
            'file.required' => 'Foto Produk Harus Diisi',
            'file.mimes' => 'Format Foto Produk Bukan JPG/PNG',
            'file.max' => 'Foto Produk Maksimal 100kb',
            'file_nama.required' => 'Nama Produk Harus Diisi',
            'file_nama.string' => 'Nama Produk Harus Kalimat',
            'file_nama.unique' => 'Nama Produk Sudah Digunakan', 
            'harga_beli.Integer' => 'Harga Beli Harus Format Angka',
            'harga_beli.min' => 'Harga Beli Minimal 0',
            'harga_jual.Integer' => 'Harga Jual Harus Format Angka',
            'harga_jual.min' => 'Harga Jual Minimal 0',
            'stok.Integer' => 'Stok Harus Format Angka',
            'stok.min' => 'Stok Minimal 0'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 200);
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
                'status' => 'sukses',
                'message' => 'Sukses Tambah Data Barang',
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
        //$barang = Barang::find($id);
        $barang = Barang::where('uuid', '=', $id)->get();

        if (!$barang) {
            return response()->json([
                'status' => 200,
                'message' => 'Data Tidak Ditemukan',
                'data' => null
            ], 200);
        } else {
            $newData = array();
            foreach($barang as $d){
                $rows['uuid'] = $d->uuid;
                $rows['file'] = 'storage/image/'.$d->file_gambar;
                $rows['file_nama'] = $d->file_nama;
                $rows['harga_beli'] = $d->harga_beli;
                $rows['harga_jual'] = $d->harga_jual;
                $rows['stok'] = $d->stok;
            
                $newData[] = $rows;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Tersedia',
                'data' => $newData
            ], 200);
        }
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
        //validation
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png|max:100',
            'file_nama' => 'required|string|unique:barang',
            'harga_beli' => 'Integer|min:0',
            'harga_jual' => 'Integer|min:0',
            'stok' => 'Integer|min:0'
        ],[
            'file.required' => 'Foto Produk Harus Diisi',
            'file.mimes' => 'Format Foto Produk Bukan JPG/PNG',
            'file.max' => 'Foto Produk Maksimal 100kb',
            'file_nama.required' => 'Nama Produk Harus Diisi',
            'file_nama.string' => 'Nama Produk Harus Kalimat',
            'file_nama.unique' => 'Nama Produk Sudah Digunakan', 
            'harga_beli.Integer' => 'Harga Beli Harus Format Angka',
            'harga_beli.min' => 'Harga Beli Minimal 0',
            'harga_jual.Integer' => 'Harga Jual Harus Format Angka',
            'harga_jual.min' => 'Harga Jual Minimal 0',
            'stok.Integer' => 'Stok Harus Format Angka',
            'stok.min' => 'Stok Minimal 0'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 200);
        }
             
        if ($file = $request->file('file')) {
            //store file into image folder
            $file->storeAs('public/image',strtotime("now").".".$request->file->extension());
            $file = strtotime("now").".".$request->file->extension(); 

            $barang = Barang::find($id);
            $barang->update([
                'file_gambar' => $file,
                'file_nama' => $request->file_nama,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok
            ]);
              
            return response()->json([
                'status' => 'sukses',
                'message' => 'Sukses Edit Data Barang',
                'data' => $barang
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $get_id = Barang::where('uuid', '=', $id)->get();
        $count = count($get_id);

        if($count>0){
            //retrieve data by id and delete
            $barang = Barang::destroy($id);
        
            //data deleted, return success response
            return response()->json([
                'status' => 200,
                'message' => 'Sukses Hapus Data Barang'
            ], 200);
        } else {
            //data deleted, return success response
            return response()->json([
                'status' => 200,
                'message' => 'Data Barang Tidak Tersedia Atau Sudah Dihapus Sebelumnya'
            ], 200);
        }
    }
}
