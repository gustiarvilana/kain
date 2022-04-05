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
                        <label for="kd_supplier" class="col-md-2 col-md-offset-1 control-label">Kode Supplier</label>
                        <div class="col-md-6">
                            <input type="text" name="kd_supplier" id="kd_supplier" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-2 col-md-offset-1 control-label">Alamat</label>
                        <div class="col-md-6">
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-md-2 col-md-offset-1 control-label">Telepon</label>
                        <div class="col-md-6">
                            <input type="text" name="telepon" id="telepon" class="form-control" required>
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
