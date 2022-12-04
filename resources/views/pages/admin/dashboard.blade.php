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
                        <div class="col-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Jumlah Pengguna (Aktivasi)</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Jumlah Pengguna (Agama)</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data User Sudah Diaktivasi</h3>
                                </div>
                                <div class="card-body">
                                    <table id="activated_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Agama</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (isset($user_group[1]))
                                                @foreach ($user_group[1] as $item)
                                                    <tr>
                                                        <td>

                                                            @if ($item->foto == null)
                                                                <img src="{{ url('photo/default.png') }}"
                                                                    alt="User Image" class="img-circle elevation-2"
                                                                    style="width: 50px; height: 50px;">
                                                            @else
                                                                <img src="{{ url("photo/{$item->foto}") }}"
                                                                    alt="" width="150px" height="100px">
                                                            @endif

                                                        </td>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>

                                                        <td style="width: 125px">

                                                            <div class="row">
                                                                <div class="col-12 mb-2">

                                                                    <select class="form-control" name="agama"
                                                                        data-id="{{ $item->id }}">
                                                                        >
                                                                        @foreach ($agama as $religion)
                                                                            <option value="{{ $religion->id }}"
                                                                                {{ $religion->id == $item->detail->agama->id ? 'selected' : '' }}>
                                                                                {{ $religion->nama_agama }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>


                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($item->is_active == 1)
                                                                <a class="btn btn-danger btn-block status"
                                                                    data-id="{{ $item->id }}">
                                                                    Nonaktif </a>
                                                            @else
                                                                <a class="btn btn-success btn-block status"
                                                                    data-id="{{ $item->id }}">
                                                                    Aktifkan </a>
                                                            @endif
                                                        </td>
                                                        <td><button type="button" class="btn btn-success btn-block"
                                                                data-toggle="modal" data-target="#modal-default"
                                                                data-user="{{ json_encode($item) }}">
                                                                Detail
                                                            </button>
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
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Agama</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data User Belum Diaktivasi</h3>
                                </div>
                                <div class="card-body">
                                    <table id="not_activated_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Agama</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($user_group[0]))

                                                @foreach ($user_group[0] as $item)
                                                    <tr>
                                                        <td>
                                                            @if ($item->foto == null)
                                                                <img src="{{ url('photo/default.png') }}"
                                                                    alt="User Image" class="img-circle elevation-2"
                                                                    style="width: 50px; height: 50px;">
                                                            @else
                                                                <img src="{{ url("photo/{$item->foto}") }}"
                                                                    alt="" width="150px" height="100px">
                                                            @endif
                                                        </td>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>

                                                        <td style="width: 125px">

                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <select class="form-control" name="agama"
                                                                        data-id="{{ $item->id }}">
                                                                        @foreach ($agama as $religion)
                                                                            <option value="{{ $religion->id }}"
                                                                                {{ $religion->id == $item->detail->agama->id ? 'selected' : '' }}>
                                                                                {{ $religion->nama_agama }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>


                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($item->is_active == 1)
                                                                <a class="btn btn-danger btn-block status"
                                                                    data-id="{{ $item->id }}">
                                                                    Nonaktif </a>
                                                            @else
                                                                <a class="btn btn-success btn-block status"
                                                                    data-id="{{ $item->id }}">
                                                                    Aktifkan </a>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endif

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Agama</th>
                                                <th>Status</th>
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
                    <h4 class="modal-title">Detail User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div>
                        <div class="row">
                            <div class="col-6">
                                <p>Foto Profil</p>
                                <img src="" id="foto_profil" alt="" width="150px" height="100px"
                                    style="object-fit: cover; object-cover:center;">
                            </div>
                            <div class="col-6">
                                <p>Foto KTP</p>
                                <img src="" alt="" id="foto_ktp" width="150px" height="100px"
                                    style="object-fit: cover; object-cover:center;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <p>Nama : </p>
                            </div>
                            <div class="col-6">
                                <p id="name"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Email : </p>
                            </div>
                            <div class="col-6">
                                <p id="email"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Alamat : </p>
                            </div>
                            <div class="col-6">
                                <p id="alamat"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Tempat Lahir : </p>
                            </div>
                            <div class="col-6">
                                <p id="tempat_lahir"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Tanggal Lahir : </p>
                            </div>
                            <div class="col-6">
                                <p id="tanggal_lahir"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Agama : </p>
                            </div>
                            <div class="col-6">
                                <p id="agama"></p>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                    </div>
                </div>

            </div>

        </div>
    </div>
    @include('partials.footer')

    <script>
        $(function() {


            $('.status').on('click', function(e) {
                //get parent of button clicked
                var parent = $(this).parent().parent();
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ url('/admin/status/') }}/" + id + "/user",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
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
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                            })
                        }
                    }
                })

            })


            const checkboxElement = $('#customSwitch1');

            if (localStorage.getItem('theme') === 'dark') {
                checkboxElement.prop('checked', true);
                $('body').addClass('dark-mode');
            }

            checkboxElement.change(function() {
                if (this.checked) {
                    localStorage.setItem('theme', 'dark');
                    document.body.classList.add('dark-mode');
                } else {
                    localStorage.setItem('theme', 'light');
                    document.body.classList.remove('dark-mode');
                }
            });


            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });


            $('select').on('change', function(e) {
                const id = $(this).data('id');
                const id_agama = $(this).val();
                $.ajax({
                    url: "{{ url('/admin/agama/') }}/" + id + "/user",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_agama
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil mengubah agama',
                            text: data.message,
                        }).then((result) => {
                            location.reload();
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal mengubah agama',
                            text: data.message,
                        })
                    }
                });
            });

            $('#modal-default').on('show.bs.modal', function(e) {
                var user = $(e.relatedTarget).data('user');

                $('#name').text(user.name);
                $('#email').text(user.email);
                $('#alamat').text(user.detail.alamat);
                $('#tempat_lahir').text(user.detail.tempat_lahir);
                $('#tanggal_lahir').text(user.detail.tanggal_lahir);
                $('#agama').text(user.detail.agama.nama_agama);
                $('#foto_profil').attr('src', user.foto_profil ||
                    "https://thumbs.dreamstime.com/b/default-profile-picture-avatar-photo-placeholder-vector-illustration-default-profile-picture-avatar-photo-placeholder-vector-189495158.jpg"
                );
                $('#foto_ktp').attr('src', user.foto_ktp ||
                    "https://jatimsmart.id/wp-content/uploads/2021/06/identity-card-people-citizens-flat-art-design_26440-26.jpg"
                );
            });

            const user_monthly_active = @json($user_monthly_active);
            const userAgamaCount = @json($userAgamaCount);
            const data = {
                'active': [],
                'not_active': []
            }

            for (const key in user_monthly_active) {
                data["active"].push(user_monthly_active[key].active);
                data['not_active'].push(user_monthly_active[key].not_active);
            }

            const areaChartData = {
                labels: Object.keys(user_monthly_active),
                datasets: [{
                        label: 'Aktif',
                        backgroundColor: 'rgba(60, 179, 113, 1)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: data['active']
                    },
                    {
                        label: 'Belum Aktif',
                        backgroundColor: 'rgba(255, 99, 71, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: data['not_active']
                    },
                ]
            }


            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)

            barChartData.datasets = areaChartData.datasets

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            const generateNarrayHex = (n) => {
                const arr = [];
                for (let i = 0; i < n; i++) {
                    arr.push('#' + Math.floor(Math.random() * 16777215).toString(16));
                }
                return arr;
            }


            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: Object.keys(userAgamaCount),
                datasets: [{
                    data: Object.values(userAgamaCount),
                    backgroundColor: generateNarrayHex(Object.keys(userAgamaCount).length),
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

        })
    </script>
</body>
