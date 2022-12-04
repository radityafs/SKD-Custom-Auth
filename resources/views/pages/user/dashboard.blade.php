@include('partials.header', ['title' => 'Dashboard Admin - Kelompok 2'])


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
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Unggahan Foto</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">

                                                <img @if ($data->foto == null) src="{{ url('photo/default.png') }}"
                                            @else
                                                src="{{ url('assets/img/foto/' . $data->foto) }}" @endif
                                                    class="img-fluid"
                                                    style="height:250px; object-fit: cover; object-cover:center; width: 100%"
                                                    alt="Responsive image">

                                                <div class="form-group mt-3">
                                                    <label for="exampleInputFile">Ubah Foto Profil</label>
                                                    <form action="{{ url('/user/photo') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="photoProfil"
                                                                    class="custom-file-input" id="validatedCustomFile"
                                                                    required>
                                                                <label class="custom-file-label"
                                                                    for="validatedCustomFile">Choose
                                                                    file...</label>
                                                                <div class="invalid-feedback">Example invalid custom
                                                                    file
                                                                    feedback
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit"
                                                            class="mt-3 btn btn-warning btn-block"><b>Ganti Foto
                                                                Profil</b></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">

                                                <div class="image-preview" style="position: relative; ">
                                                    <img src="{{ url('photo/' . $data->detail->foto_ktp) }}"
                                                        class="img-fluid"
                                                        style="height:250px; object-fit: cover; object-cover:center; width: 100%"
                                                        alt="Responsive image">
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="exampleInputFile">Ubah Foto KTP</label>
                                                    <form action="{{ url('/user/photoKTP') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="photoKTP"
                                                                    class="custom-file-input" id="validatedCustomFile"
                                                                    required>
                                                                <label class="custom-file-label"
                                                                    for="validatedCustomFile">Choose
                                                                    file...</label>
                                                                <div class="invalid-feedback">Example invalid custom
                                                                    file
                                                                    feedback
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" id="editFotoKTP"
                                                            class="mt-3 btn btn-warning btn-block"><b>Edit
                                                                Foto KTP</b></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Formulir data</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $data->name }}" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" placeholder="Nama Lengkap"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email" name="email" value="{{ $data->email }}"
                                                        class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" placeholder="Email">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                                    <input type="date" value="{{ $data->detail->tanggal_lahir }}"
                                                        name="tanggal_lahir" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                                        placeholder="Tanggal Lahir">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat</label>
                                                    <input type="text" value="{{ $data->detail->alamat }}"
                                                        name="alamat" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" placeholder="Alamat">
                                                </div>



                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                                    <input type="text" value="{{ $data->detail->tempat_lahir }}"
                                                        name="tempat_lahir" id="tempat_lahir" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                                        placeholder="Tempat Lahir">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Agama</label>
                                                    <select class="form-control" name="id_agama" id="agama">
                                                        <option value="" disabled>Pilih Agama</option>
                                                        @foreach ($agama as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $data->detail->id_agama == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama_agama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-5">
                                            <div class="col-sm-12 mb-3 col-md-6">
                                                <button type="button" data-target="#modal-default"
                                                    data-toggle="modal" class="btn btn-danger btn-block"><b>Ganti
                                                        Password</b></button>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <button type="submit" id="submitData"
                                                    class="btn btn-warning btn-block"><b>Simpan
                                                        Perubahan</b></button>
                                            </div>
                                        </div>
                                    </form>

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
                    <h4 class="modal-title">Ganti Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="agama">Password Lama</label>
                                <input type="text" class="form-control" id="oldPassword">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="agama">Password Baru</label>
                                <input type="text" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="agama">Ulangi Password Baru</label>
                                <input type="text" class="form-control" id="repassword">
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


            // listen modal open
            $('#modal-default').on('shown.bs.modal', function(e) {

                //listen button save click
                $('#save').click(function() {
                    //get value from input modal
                    var oldPassword = $('#oldPassword').val();
                    var password = $('#password').val();
                    var repassword = $('#repassword').val();

                    //check if password and repassword is same
                    if (password == repassword) {
                        //if true, send ajax
                        $.ajax({
                            url: "{{ url('user/password') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                old_password: oldPassword,
                                password: password,
                                repassword: repassword
                            },
                            success: function(data) {
                                //if success, show alert success
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Password berhasil diubah',
                                })
                                //close modal
                                $('#modal-default').modal('hide');
                            },
                            error: function(data) {
                                //if error, show alert error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Password lama salah',
                                })
                            }
                        })
                    } else {
                        //if false, show alert error
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Password tidak sama',
                        })
                    }
                })

            });


            $("#submitData").click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ url('/user/profile') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: $('input[name=name]').val(),
                        email: $('input[name=email]').val(),
                        tanggal_lahir: $('input[name=tanggal_lahir]').val(),
                        tempat_lahir: $('input[name=tempat_lahir]').val(),
                        alamat: $('input[name=alamat]').val(),
                        id_agama: $('select[name=id_agama]').val(),
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                            }).then((result) => {
                                location.reload();
                            })
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message,
                        })
                    }
                })
            });


            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        })
    </script>
</body>
