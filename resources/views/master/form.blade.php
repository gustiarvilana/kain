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
                            <input type="text" name="kd_produk" id="kd_produk" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kd_jenis" class="col-md-2 col-md-offset-1 control-label">Kode Jenis</label>
                        <div class="col-md-6">
                            <input type="text" name="kd_jenis" id="kd_jenis" class="form-control" required>
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
                        <label for="berat_kg" class="col-md-2 col-md-offset-1 control-label">Berat (kg)</label>
                        <div class="col-md-6">
                            <input type="text" name="berat_kg" id="berat_kg" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_kg" class="col-md-2 col-md-offset-1 control-label">Harga /kg</label>
                        <div class="col-md-6">
                            <input type="text" name="harga_kg" id="harga_kg" class="form-control" required>
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
                        <label for="sts_produk" class="col-md-2 col-md-offset-1 control-label">Status</label>
                        <div class="col-md-6">
                            <input type="text" name="sts_produk" id="sts_produk" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_beli" class="col-md-2 col-md-offset-1 control-label">Harga Beli</label>
                        <div class="col-md-6">
                            <input type="text" name="harga_beli" id="harga_beli" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hpp" class="col-md-2 col-md-offset-1 control-label">Harga Jual</label>
                        <div class="col-md-6">
                            <input type="text" name="hpp" id="hpp" class="form-control" required>
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
