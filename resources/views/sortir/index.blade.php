@extends('layouts.master')

@section('title')
Data Sortir
@endsection

@section('content')
@if (Session::has('success'))
   <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
<div class="card">
    <div class="card-header">
        <div class="btn btn-success btn-lg mr-2" onclick="addform('{{ route('sortir.store') }}')"><i class="fa fa-plus-circle" aria-hidden="true"></i> Input Sortir </div>
    </div>
    <div class="card-body ">
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-striped table-inverse" id="table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Kode Jenis</th>
                            <th>Kode Supplier</th>
                            <th>Warna</th>
                            <th>berat</th>
                            <th>Jumlah</th>
                            <th>Tgl Sortir</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer"></div>
</div>

@include('sortir.form')
@endsection

@push('script')
<script>
    // let name = $("#filter_name").val()

    $(document).ready(function () {
        var table = $('.table').DataTable({
            proccesing: true,
            searching:true,
            paging:false,
            autoWidth: false,
            ajax: {
                url: '{{ route('sortir.data') }}',
                // data: function(d){
                //     d.name = name;
                // }
            },
            columns: [
                {data: 'DT_RowIndex',searcable: false,sortable: false},
                {data: 'kd_produk'},
                {data: 'kd_jenis'},
                {data: 'kd_supplier'},
                {data: 'warna'},
                {data: 'berat'},
                {data: 'jumlah'},
                {data: 'tgl_sortir'},
                {data: 'aksi'},
            ],

        });

        $('#modal-form').validator().on('submit', function (e) {
            if (!e.preventDefault()) {
                $.ajax({
                        url: $('#modal-form form').attr('action'),
                        type: "post",
                        data: $('#modal-form form').serialize()
                    })
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        $('#table').DataTable().ajax.reload()
                    })
                    .fail((errors) => {
                        alert('Tidak dapat Menyimpan Data');
                        return;
                    });
            }
        })
    });

    function addform(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah User');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    };

    function editform(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit User');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');

        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_sortir]').val(response.id_sortir);
                $('#modal-form [name=id_jenis]').val(response.id_jenis);
                $('#modal-form [name=id_supplier]').val(response.id_supplier);
                $('#modal-form [name=warna]').val(response.warna);
                $('#modal-form [name=berat]').val(response.berat);
                $('#modal-form [name=jumlah]').val(response.jumlah);
                $('#modal-form [name=tgl_sortir]').val(response.tgl_sortir);
            })
            .fail((errors) => {
                alert('Tidak Dapat menampilkan data');
                return;
            });
    };

    function deleteform(url) {
        if (confirm('Yakin Akan Menghapus data???')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    $('#table').DataTable().ajax.reload()

                })
                .fail((errors) => {
                    return alert('Tidak Dapat Menghapus Data');
                });
        }
    }
</script>
@endpush
