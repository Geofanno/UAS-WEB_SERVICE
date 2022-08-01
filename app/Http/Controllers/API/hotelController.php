<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hotel;
use Illuminate\Support\Facades\Validator;

class hotelController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $hotel = hotel::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $hotel
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $hotel = hotel::where('id_kamar', $id)->first();
        if (empty($hotel)) {
            return response()->json(['pesan' => 'Data Kamar Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Kamar Berhasil Ditemukan', 'data' => $hotel], 200);
    }
    // menambah data
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_kamar' => 'required',
            'jenis_kamar' => 'required',
            'harga_kamar' => 'required',
            'deskripsi' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data kamar gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = hotel::create($request->all());
        return response()->json(['pesan' => 'data kamar berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $hotel = hotel::where('id_kamar', $id)->first();
        if (empty($hotel)) {
            return response()->json(['pesan' => 'data kamar tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nama_kamar' => 'required',
                'jenis_kamar' => 'required',
                'harga_kamar' => 'required',
                'deskripsi' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Kamar Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $data = hotel::where("id_kamar", $id)->update($request->all());
            return response()->json(['pesan' => 'Data Kamar Berhasil disimpan', 'data' => $data], 200);
        }
    }
    
    // Hapus data berdasar id
    public function destroy($id)
    {
        $hotell = hotel::where('id_kamar', $id)->first();
        if (empty($hotell)) {
            return response()->json(['pesan' => 'Data Kamar Tidak ditemukan', 'data' => ''], 404);
        }
        $data = hotel::where("id_kamar", $id)->delete();
        return response()->json(['pesan' => 'Data Kamar Berhasil dihapus', 'data' => $data]);
       
    }
        public function indexRelasi()
        {
            $hotel = hotel::with('order')->get();
            return response()->json(['pesan' => 'Data Kamar Berhasil ditemukan', 'data' => $hotel], 200);
        }

    }
