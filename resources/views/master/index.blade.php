@extends('layouts.master')

@section('title')
Data master
@endsection

@section('content')
@if (Session::has('success'))
   <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
<div class="card">
    {{-- <div class="card-header"> --}}
        {{--  --}}
    {{-- </div> --}}
    <div class="card-body ">
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-striped table-inverse" id="table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Nama Jenis</th>
                            <th>Warna</th>
                            <th>Berat (kg)</th>
                            <th>harga (/kg)</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
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

@include('master.form')
@endsection

@push('script')
<script>
    // let name = $("#filter_name").val()

    $(document).ready(function () {
        var table = $('.table').DataTable({
            proccesing: true,
            searching:true,
            autoWidth: false,
            ajax: {
                url: '{{ route('master.data') }}',
                // data: function(d){
                //     d.name = name;
                // }
            },
            columns: [
                {data: 'DT_RowIndex',searcable: false,sortable: false},
                {data: 'kd_produk'},
                {data: 'jenis'},
                {data: 'warna'},
                {data: 'berat_kg'},
                {data: 'harga_kg'},
                {data: 'jumlah'},
                {data: 'sts_produk'},
                {data: 'harga_beli'},
                {data: 'hpp'},
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
                $('#modal-form [name=kd_produk]').val(response.kd_produk);
                $('#modal-form [name=jenis]').val(response.jenis);
                $('#modal-form [name=warna]').val(response.warna);
                $('#modal-form [name=berat_kg]').val(response.berat_kg);
                $('#modal-form [name=harga_kg]').val(response.harga_kg);
                $('#modal-form [name=jumlah]').val(response.jumlah);
                $('#modal-form [name=sts_produk]').val(response.sts_produk);
                $('#modal-form [name=harga_beli]').val(response.harga_beli);
                $('#modal-form [name=hpp]').val(response.hpp);
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
