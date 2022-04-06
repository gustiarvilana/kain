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
                        <label for="id_penjualan" class="col-md-2 col-md-offset-1 control-label">ID Penjualan</label>
                        <div class="col-md-6">
                            <input type="text" name="id_penjualan" id="id_penjualan" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kd_produk" class="col-md-2 col-md-offset-1 control-label">KD Produk</label>
                        <div class="col-md-6">
                            <input type="text" name="kd_produk" id="kd_produk" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="warna" class="col-md-2 col-md-offset-1 control-label">Warna</label>
                        <div class="col-md-6">
                            <input type="text" name="warna" id="warna" class="form-control" required>
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
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-md-offset-1 control-label">Jumlah</label>
                        <div class="col-md-6">
                            <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_satuan" class="col-md-2 col-md-offset-1 control-label">Harga Satuan</label>
                        <div class="col-md-6">
                            <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_total" class="col-md-2 col-md-offset-1 control-label">Harga total</label>
                        <div class="col-md-6">
                            <input type="text" name="harga_total" id="harga_total" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_trs" class="col-md-2 col-md-offset-1 control-label">Tgl Transaksi</label>
                        <div class="col-md-6">
                            <input type="text" name="tgl_trs" id="tgl_trs" class="form-control" required>
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
