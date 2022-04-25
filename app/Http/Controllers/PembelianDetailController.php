<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request, $id)
    {
        $filter = $request->input('name');

        if ($filter != null) {
            $detail = DB::table('tbl_penjualan_master')
                ->where('nama_customer', 'like', '%' . $filter . '%')
                ->orWhere('nosp', $filter);
        }

        $detail = PenjualanDetail::with('Produk')
            ->where('id_penjualan_detail', $id)
            ->get();

        $data = array();
        $total = 0;
        $total_item = 0;


        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="label label-success">' . $item->produk['kd_produk'] . '</span';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga']  = 'Rp. ' . format_uang($item->harga_produk);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->id_penjualan_detail . '" data-produk="' . $item->id_produk . '" value="' . $item->jml_barang . '">';
            $row['diskon']      = $item->diskon . '%';
            $row['subtotal']    = 'Rp. ' . format_uang($item->total_harga);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('transaksi.destroy', $item->id_produk) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_produk * $item->jml_barang;
            $total_item += $item->jml_barang;
        }
        $data[] = [
            'kode_produk' => '
                <div class="total hidden ">' . $total . '</div>
                <div class="total_item hidden ">' . $total_item . '</div>',
            'nama_produk' => '',
            'harga'  => '',
            'jumlah'      => '',
            'diskon'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
            ->make(true);
    }

    public function index()
    {
        $periode_open = DB::table('tbl_periode')->where('nik_tm', Auth::user()->nik)->where('tgl_akhir', null)->first();
        $produk = DB::table('tbl_produk')->orderBy('nama_produk')->get();
        $id_penjualan = session('id_penjualan');

        // Cek apakah ada transaksi yang sedang berjalan
        if (session('id_penjualan')) {
            $marketing = DB::table('tbl_group_marketing')->where('nik_tm', Auth::user()->nik)->orderBy('nama_sales', 'ASC')->get();
            $penjualan = DB::table('tbl_penjualan_master')->where('id_penjualan', session('id_penjualan'));
            $provinsi = DB::table('tbl_place_provinsi')
                ->where('prov_id', '12')
                ->orwhere('prov_id', '13')
                ->orderBy('prov_name', 'ASC')
                ->get();

            // cek periode sudah mulai
            if ($periode_open == null) {
                return redirect()->route('penjualan_master.index')->with('error', 'Mohon Set Periode Mulai!');
            }

            return view('penjualan_detail.index', compact('produk', 'id_penjualan', 'provinsi', 'marketing'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->id_member = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);
        return redirect()->route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = DB::table('tbl_produk')->where('id_produk', $request->id_produk)->first();
        if (!$produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        DB::table('tbl_pembelian_detail')->where('kd_pembelian', $request->input('kd_pembelian'))->update([
            'kd_pembelian'  =>  $request->input('kd_pembelian'),
            'kd_produk'     =>  $request->input('kd_produk'),
            'warna'         =>  $request->input('warna'),
            'harga_satuan'  =>  $request->input('harga_satuan'),
            'berat'         =>  $request->input('berat'),
            'sts'           =>  $request->input('sts'),
            'total_harga'   =>  $request->input('total_harga'),
        ]);

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = DB::table('tbl_pembelian_detail')->where('kd_produk', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">' . $detail->produk->kode_produk . '</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. ' . format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. ' . format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('penjualan.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        return view('penjualan.nota_kecil', compact('setting', 'penjualan', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        $pdf = PDF::loadView('penjualan.nota_besar', compact('setting', 'penjualan', 'detail'));
        $pdf->setPaper(0, 0, 609, 440, 'potrait');
        return $pdf->stream('Transaksi-' . date('Y-m-d-his') . '.pdf');
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
        $harga = PenjualanDetail::where('id_penjualan_detail', $id)->where('id_produk', $request->produk)->first();
        $total_harga = $harga->harga_produk * $request->jumlah;

        DB::table('tbl_penjualan_detail')
            ->where('id_produk', $request->produk)
            ->where('id_penjualan_detail', $id)
            ->update([
                'jml_barang' => $request->jumlah,
                'total_harga' => $total_harga
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_penjualan = session('id_penjualan');
        $detail = PenjualanDetail::where('id_penjualan_detail', $id_penjualan)->where('id_produk', $id);
        $detail->delete();

        return response(null, 204);
    }

    public function detail($id)
    {
        $customer = DB::table('tbl_penjualan_detail')
            ->where('nosp', $id)->get();
        return response()->json($customer);
    }

    public function getkota(Request $request)
    {
        $kota = DB::table('tbl_place_kota')->where("prov_id", $request->prov_id)
            ->orderBy('city_name', 'ASC')->pluck('city_id', 'city_name');
        return response()->json($kota);
    }
    public function getkecamatan(Request $request)
    {
        $kecamatan = DB::table('tbl_place_kecamatan')->where("city_id", $request->city_id)
            ->orderBy('dis_name', 'ASC')->pluck('dis_id', 'dis_name');
        return response()->json($kecamatan);
    }
    public function getkelurahan(Request $request)
    {
        $kelurahan = DB::table('tbl_place_kelurahan')->where("dis_id", $request->dis_id)
            ->orderBy('subdis_name', 'ASC')->pluck('subdis_id', 'subdis_name');
        return response()->json($kelurahan);
    }

    public function loadForm($total = 0)
    {
        $batch_user = Auth::user()->nik;

        $data    = [
            'totalrp' => format_uang($total),
            'batch_user' => $batch_user,
        ];

        return response()->json($data);
    }
}
