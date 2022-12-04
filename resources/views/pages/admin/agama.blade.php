@include('partials.header', ['title' => 'Agama Data - Kelompok 2'])

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ url('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Kelompok 2</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @include('partials.sidebar')
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6 float-right">
                            <div class="w-full float-right">
                                <div class="custom-control custom-switch mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Dark Mode</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <section class="content">



                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <div class="w-full d-flex justify-content-between">
                                        <h3 class="card-title">Data Agama</h3>
                                        <a class="btn btn-success" data-target="#modal-default"
                                            data-toggle="modal">Tambah Data</a>
                                    </div>


                                </div>
                                <div class="card-body">
                                    <table id="data_agama" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Agama</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (isset($agama))
                                                @foreach ($agama as $a)
                                                    <tr>
                                                        <td style="width: 10%;">{{ $a->id }}</td>
                                                        <td style="width: 70%">{{ $a->nama_agama }}</td>
                                                        <td style="width: 20%">
                                                            <a class="btn btn-warning btn-sm" data-toggle="modal"
                                                                data-target="#modal-default" data-action="edit"
                                                                data-agama="{{ json_encode($a) }}">Edit</a>
                                                            <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#modal-default" data-action="delete"
                                                                data-agama="{{ json_encode($a) }}">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Agama</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id='action'>Tambah Agama</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="hidden" id="id_agama">
                                <input type="text" class="form-control" id="agama" name="agama"
                                    placeholder="Agama">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    <script>
        $(function() {

            const url = "{{ url('admin/agama') }}";

            const store = (agama) => {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        nama_agama: agama,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil ditambahkan',
                        })
                        $('#modal-default').modal('hide');
                        location.reload();
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                })
            }

            const update = (id, agama) => {
                $.ajax({
                    url: url + '/' + id + '/update',
                    type: 'POST',
                    data: {
                        nama_agama: agama,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil diubah',
                        })
                        $('#modal-default').modal('hide');
                        location.reload();
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                })
            }

            const destroy = (id) => {
                $.ajax({
                    url: url + '/' + id + '/delete',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil dihapus',
                        })
                        $('#modal-default').modal('hide');
                        location.reload();
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                })
            }

            $('#data_agama').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });


            $('#modal-default').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var action = button.data('action')
                var agama = button.data('agama')
                var modal = $(this)
                if (action == 'delete') {

                    modal.find('.modal-title').text('Hapus Agama')
                    modal.find('#id_agama').val(agama.id)
                    modal.find('#agama').attr('disabled', true)
                    modal.find('#agama').val(agama.nama_agama)
                    modal.find('#save').text('Delete')
                    modal.find('#save').attr('class', 'btn btn-danger')

                    $('#save').on('click', function() {
                        destroy(agama.id)
                    })
                } else if (action == "edit") {
                    modal.find('.modal-title').text('Edit Agama')
                    modal.find('#agama').attr('disabled', false)

                    modal.find('#id_agama').val(agama.id)
                    modal.find('#agama').val(agama.nama_agama)
                    modal.find('#save').text('Edit')
                    modal.find('#save').attr('class', 'btn btn-warning')

                    $('#save').on('click', function() {
                        update(agama.id, $('#agama').val())
                    })
                } else {
                    modal.find('.modal-title').text('Tambah Agama')
                    modal.find('#id_agama').val('')
                    modal.find('#agama').attr('disabled', false)
                    modal.find('#agama').val('')
                    modal.find('#save').text('Save')
                    modal.find('#save').attr('class', 'btn btn-primary')

                    $('#save').on('click', function() {
                        store($('#agama').val())
                    })
                }
            })
        });
    </script>
</body>
