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
                    <button onclick="deleteform(`' . route('pembelian.destroy', $pembelian->kd_pembelian) . '`)" class="btn btn-danger btn-xs">Hapus</button>
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

        $pembelian = DB::table('tbl_pembelian')->orderBy('id_pembelian', 'desc')->first();
        if ($pembelian == null) {
            $pembelian = 0;
        } elseif ($pembelian != null) {
            $pembelian = $pembelian->id_pembelian;
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
        if (!$request->kd_supplier || !$request->total_harga) {
            return redirect()->back()->withErrors(['msg' => 'Pastikan semua kolom sudah terisi!']);
        } else {
            Pembelian::where('kd_pembelian', session('kd_pembelian'))->update([
                'kd_supplier' => $request->kd_supplier,
                'tgl_trs' => $request->tgl_trs,
                'jumlah' => $request->jumlah,
                'total_harga' => $request->total_harga,
            ]);
        }

        // update data MAster
        $produkDetail = PembelianDetail::where('kd_pembelian', session('kd_pembelian'))->get();
        foreach ($produkDetail as $value) {
            $master = Master::where('kd_produk', $value['kd_produk'])->first();

            $status = $value['sts'];
            if ($status == 5) {
                $siap_giling = $master->stok_sortir + $value['berat'];
            } elseif ($status == 1) {
                $siap_giling = $master->stok_sortir;
            }

            $master->update([
                'stok_global' => $master['stok_global'] + $value['berat'],
                'stok_sortir' =>  $siap_giling,
                'stok_giling' =>  0,
                'penyusutan' => 0,
                'harga_beli' => $master['harga_beli'] + $value['total_harga'],
                'hpp' => $master['hpp'] + $value['total_harga'],
            ]);
        }
        // update data MAster

        session()->forget('kd_pembelian');
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil disimpan');
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
        $pembelian = DB::table('tbl_pembelian')->where('kd_pembelian', $id);
        $pembelianDt = DB::table('tbl_pembelian_detail')->where('kd_pembelian', $id);
        $pembelian->delete();
        $pembelianDt->delete();

        return response(null, 204);
    }
}
