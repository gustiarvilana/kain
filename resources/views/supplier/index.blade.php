@extends('layouts.master')

@section('title')
Data Supplier
@endsection

@section('content')
@if (Session::has('success'))
   <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
<div class="card">
    <div class="card-header">
        <div class="group-inline">
            <div class="btn btn-success btn-xs mr-2" onclick="addform('{{ route('supplier.store') }}')"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Supplier</div>
        </div>
    </div>
    <div class="card-body ">
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-striped table-inverse" id="table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>kode Supplier</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer"></div>
</div>

@include('supplier.form')
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
                url: '{{ route('supplier.data') }}',
                // data: function(d){
                //     d.name = name;
                // }
            },
            columns: [
                {data: 'DT_RowIndex',searcable: false,sortable: false},
                {data: 'kd_supplier'},
                {data: 'nama'},
                {data: 'alamat'},
                {data: 'telepon'},
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
        $('#modal-form .modal-title').text('Tambah Supplier');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    };

    function editform(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Supplier');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');

        $.get(url)
            .done((response) => {
                $('#modal-form [name=kd_supplier]').val(response.kd_supplier);
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=alamat]').val(response.alamat);
                $('#modal-form [name=telepon]').val(response.telepon);
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
