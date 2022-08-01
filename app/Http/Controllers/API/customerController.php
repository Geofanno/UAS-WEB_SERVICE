<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Support\Facades\Validator;

class customerController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $customer = customer::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $customer
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $customer = customer::where('id', $id)->first();
        if (empty($customer)) {
            return response()->json(['pesan' => 'Data Penyewa Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Penyewa Berhasil Ditemukan', 'data' => $customer], 200);
    }
    // menambah data
    public function store(Request $request)
    {
     
        $validasi = Validator::make($request->all(), [
            'nama_penyewa' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'email' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data penyewa gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = customer::create($request->all());
        return response()->json(['pesan' => 'data penyewa berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        $customers = customer::where('id', $id)->first();
        if (empty($customers)) {
            return response()->json(['pesan' => 'data penyewa tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nama_penyewa' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required|numeric',
                'email' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Penyewa Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $customers->update($request->all());
            return response()->json(['pesan' => 'Data Penyewa Berhasil disimpan', 'data' => $customers], 200);
        }
    }
    // Hapus data berdasar id
    public function destroy($id)
    {
        $customers = customer::where('id', $id)->first();
        if (empty($customers)) {
            return response()->json(['pesan' => 'Data Penyewa Tidak ditemukan', 'data' => ''], 404);
        }
        $customers->delete();
        return response()->json(['pesan' => 'Data Penyewa Berhasil dihapus', 'data' => $customers]);
    }
    public function indexRelasi()
    {
        $hotel = customer::with('sewa')->get();
        return response()->json(['pesan' => 'Data Penyewa Berhasil ditemukan', 'data' => $hotel], 200);
    }
}