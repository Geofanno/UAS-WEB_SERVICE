<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Support\Facades\Validator;

class orderController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $order = order::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $order
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $order = order::where('id', $id)->first();
        if (empty($order)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $order], 200);
    }
    // menambah data
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'customer_id' => 'required',
            'id_kamar' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'no_ktp' => 'required',
            'total' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = order::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        $order = order::where('id', $id)->first();
        if (empty($order)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'customer_id' => 'required',
                'checkin' => 'required',
                'checkout' => 'required',
                'no_ktp' => 'required',
                'total' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $order->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $order], 200);
        }
    }
    
    // Hapus data berdasar id
    public function destroy($id)
    {
        $order = order::where('id', $id)->first();
        if (empty($order)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $order->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $order]);
       
    }
        public function indexRelasi()
        {
            $order = order::with('customer','mobil')->get();
            return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $order], 200);
        }

    }
