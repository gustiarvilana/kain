@extends('layouts.master')

@push('css')
<style>
    .dt-buttons {
        display: none;
        position: inherit;
        text-align:right;
        margin: left;
        margin-right: 30%;
    }
    .dataTables_filter {
        position: inherit;
        margin: right;
    }
</style>
@endpush

@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-penjualan tbody tr:last-child {
        display: none;
    }

    .text-total{
        font-size: 30px;
        font-weight: bold;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('title')
    Page Pembelian Detail
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="text-center">
                    @if($errors->any())
                    <span class="badge badge-danger"><h4>Error : {{$errors->first()}}</h4></span>
                    @endif
                </div>
                    id_penjualan : {{ $session }}
                <form class="form-produk">
                    @csrf
                    <div class="form-group row">
                        <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <input type="hidden" name="kd_pembelian" id="kd_pembelian" value="{{ $session }}">
                                <input type="text" class="form-control" name="kd_produk" id="kd_produk" value="">
                                <span class="input-group-btn">
                                    <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button">Pilih Produk <i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-stiped table-bordered table-penjualan table-responsive">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th width="15%">Jumlah</th>
                        <th>Status</th>
                        <th>Subtotal</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>

                <hr class="sidebar-divider">

                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('pembelian.store') }}" class="form-penjualan form-horizontal" method="post">
                            @csrf
                             <div class="form-group row">
                                <label for="tgl_trs" class="col-lg-1 control-label">Tanggal Trs</label>
                                <div class="col-lg-2">
                                    <input type="text" name="tgl_trs" id="tgl_trs" value="{{ date('Ymd') }}" class="form-control" readonly>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="kd_supplier" class="col-lg-1 control-label">Kd Supplier</label>
                                <div class="col-lg-2">
                                    <select name="kd_supplier" id="kd_supplier" class="form-control" required>
                                        <option value="">Piih Supplier</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->kd_supplier }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="totalrp" class="col-lg-1 control-label">Total</label>
                                <div class="col-lg-8">
                                    <input type="text" id="totalrp" class="form-control text-total" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="total_harga" id="total">
                                <input type="text" name="jumlah" id="total_item">
                            </div>
                            <div class="col-lg-8">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>
@includeIf('pembelian_detail.form')
@endsection

@push('script')
<script>
    let table, table2;
    $(function () {
        $('body').addClass('sidebar-collapse');

        table = $('.table-penjualan').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('pembelianDetail.data', $session) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'harga'},
                {data: 'jumlah'},
                {data: 'sts'},
                {data: 'subtotal'},
                {data: 'aksi', searchable: false, sortable: false},
            ],
            dom: 'Brt',
            bSort: false,
            paginate: false
        });

        table2 = $('.table-produk').DataTable();

        $(document).on('input', '.quantity', function () {
            let id = $(this).data('id');
            let produk = $(this).data('produk');
            let jumlah = parseInt($(this).val());

            if (jumlah < 1) {
                $(this).val(1);
                alert('Jumlah tidak boleh kurang dari 1');
                return;
            }
            if (jumlah > 10000) {
                $(this).val(10000);
                alert('Jumlah tidak boleh lebih dari 10000');
                return;
            }

            $.post(`{{ url('/pembelianDetail/update') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'post',
                    'jumlah': jumlah,
                    'produk': produk,
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload(() => loadForm());
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data quantitiy');
                    return;
                });
        });

        $(document).on('input', '.status', function () {
            let id = $(this).data('id');
            let produk = $(this).data('produk');
            let sts =$(this).val();
            console.log(sts);

            $.post(`{{ url('/pembelianDetail/update') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'post',
                    'sts': sts,
                    'produk': produk,
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload(() => loadForm());
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data quantitiy');
                    return;
                });
        });

        $('.btn-simpan').on('click', function () {
            $('.form-penjualan').submit();
        });
    });

    function tampilProduk() {
        $('#modal-produk').modal('show');
    }

    function pilihProduk(kode) {
        $('#kd_produk').val(kode);
        $('#modal-produk').modal('hide');
        tambahProduk();
    }

    function tambahProduk() {
        console.log($('.form-produk').serialize())
        $.post('{{ route('pembelianDetail.store') }}', $('.form-produk').serialize())
            .done(response => {
                $('#kd_produk').focus();
                table.ajax.reload(() => loadForm());
                table.ajax.reload();
            })
            .fail(function(xhr, status, error) {
                alert(xhr.responseText)
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload(() => loadForm());
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }

    function loadForm() {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());
        $('#total_item').val();
        $.get(`{{ url('/pembelianDetail/loadform') }}/${$('.total').text()}`)
            .done(response => {
                $('#totalrp').val('Rp. '+ response.totalrp);
            })
            .fail(function(xhr, status, error) {
                alert(xhr.responseText)
                return;
            });
    }
</script>
@endpush
