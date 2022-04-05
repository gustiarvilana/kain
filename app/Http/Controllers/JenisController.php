<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $jenis = Jenis::all();

        return datatables()::of($jenis)
            ->addIndexColumn()
            ->addColumn('aksi', function($jenis){
                return '
                    <button onclick="editform(`'. route('jenis.update',$jenis->kd_jenis) .'`)" class="btn btn-info btn-xs">Edit</button>
                    <button onclick="deleteform(`'. route('jenis.destroy',$jenis->kd_jenis) .'`)" class="btn btn-danger btn-xs">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function index()
    {
        return view('jenis.index');
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
        Jenis::create($request->all());

        return redirect()->back()->with('success', 'Berhasil menambahkan jenis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $jenis = Jenis::where('kd_jenis',$id)->first();
        return response()->json($jenis);
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
        $data =$request->except('_token','_method');
        $user = Jenis::where('kd_jenis',$id);

        $user->update($data);

        return response()->json('Data Berhasil Update',200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Jenis::where('kd_jenis',$id);
        $jenis->delete();

        return response(null,204);
    }
}
