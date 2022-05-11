<?php

namespace App\Http\Controllers;

use App\Models\Giling;
use App\Models\Jenis;
use App\Models\Master;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $pembelian = DB::table('tbl_pembelian as a');

        return datatables()::of($pembelian)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pembelian) {
                return '
                    <button onclick="editform(`' . route('pembelian.update', $pembelian->id_pembelian) . '`)" class="btn btn-info btn-xs">Edit</button>
                    <button onclick="deleteform(`' . route('pembelian.destroy', $pembelian->id_pembelian) . '`)" class="btn btn-danger btn-xs">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function index()
    {
        // hapus kosong
        session()->forget('kd_pembelian');
        DB::table('tbl_pembelian')->where('kd_supplier', '0')->where('tgl_trs', '0')->delete();

        $produks = Produk::all();
        $jeniss = Jenis::all();
        $suppliers = Supplier::all();
        return view('pembelian.index', compact('produks', 'jeniss', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pembelian::where('kd_supplier', '0')->where('tgl_trs', '0')->delete();
        PembelianDetail::where('kd_produk', '0')->where('total_harga', '0')->delete();

        $pembelian = Pembelian::latest('id_pembelian')->first();
        if ($pembelian == null) {
            $pembelian = 0;
        }
        $kd_pembelian = kode('PK', $pembelian);

        DB::table('tbl_pembelian')->insert([
            'kd_pembelian' => $kd_pembelian,
            'kd_supplier' => '0',
            'tgl_trs' => '0',
            'jumlah' => '0',
            'total_harga' => '0',
        ]);
        session(['kd_pembelian' => $kd_pembelian]);

        return redirect()->route('pembelianDetail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembelian = Pembelian::where('id_pembelian', $id)->first();
        return response()->json($pembelian);
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
        $data = $request->all();
        $data = $request->except('_token', '_method');
        $user = Pembelian::where('id_pembelian', $id);

        $user->update($data);

        return response()->json('Data Berhasil Update', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::where('id_pembelian', $id);
        $pembelian->delete();


        return response(null, 204);
    }
}
