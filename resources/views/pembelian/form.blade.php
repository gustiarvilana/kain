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
                        <label for="id_produk" class="col-md-2 col-md-offset-1 control-label">Kode Produk</label>
                        <div class="col-md-6">
                            <input type="text" name="id_produk" id="id_produk" class="form-control" required>
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
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-md-offset-1 control-label">Jumlah</label>
                        <div class="col-md-6">
                            <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sts" class="col-md-2 col-md-offset-1 control-label">Status</label>
                        <div class="col-md-6">
                            <input type="text" name="sts" id="sts" class="form-control" required>
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
                        <label for="total_harga" class="col-md-2 col-md-offset-1 control-label">Total Harga</label>
                        <div class="col-md-6">
                            <input type="text" name="total_harga" id="total_harga" class="form-control" required>
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
