<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <form action="" class="form-horizontal" method="post">
            @csrf
            @method('')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="kd_produk" class="col-md-2 col-md-offset-1 control-label">Kode Produk</label>
                        <div class="col-md-6">
                            <select name="kd_produk" id="kd_produk" class="form-control">
                                <option value=""></option>
                                @foreach ($produks as $produk)
                                <option value="{{ $produk->kd_produk }}">{{ $produk->kd_produk }} / {{ $produk->nama_produk }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    {{--  <div class="form-group row">
                        <label for="kd_jenis" class="col-md-2 col-md-offset-1 control-label">Kode Jenis</label>
                        <div class="col-md-6">
                            <input type="text" name="kd_jenis" id="kd_jenis" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>  --}}
                    <div class="form-group row">
                        <label for="kd_supplier" class="col-md-2 col-md-offset-1 control-label">Kode Supplier</label>
                        <div class="col-md-6">
                            <select name="kd_supplier" id="kd_supplier" class="form-control">
                                <option value=""></option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->kd_supplier }}">{{ $supplier->kd_supplier }} / {{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="warna" class="col-md-2 col-md-offset-1 control-label">Warna</label>
                        <div class="col-md-6">
                            <select name="warna" id="warna" class="form-control">
                                <option value=""></option>
                                <option value="bening">Bening</option>
                                <option value="putih">Merah</option>
                                <option value="hitam">Hitam</option>
                                <option value="kuning">kuning</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berat" class="col-md-2 col-md-offset-1 control-label">Berat</label>
                        <div class="col-md-6">
                            <input type="text" name="berat" id="berat" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    {{--  <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-md-offset-1 control-label">Jumlah</label>
                        <div class="col-md-6">
                            <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>  --}}
                    <div class="form-group row">
                        <label for="tgl_sortir" class="col-md-2 col-md-offset-1 control-label">Tgl_sortir</label>
                        <div class="col-md-6">
                            <input type="date" name="tgl_sortir" id="tgl_sortir" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-xs btn-primary">Simpan</button>
                    <button class="btn btn-xs btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>

    </div>
</div>
