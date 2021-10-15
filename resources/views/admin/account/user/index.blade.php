@extends('layouts.app', ['title' => 'KPR | Register KPR'])
@section('dashboard', 'KELOLA ACCOUNT')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                  @include('layouts.partials.error')
                  <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-md" data-toggle="modal" data-target="#addModal">Add</button>
                  </div>
                </div> --}}
                <div class="card-header d-flex">
                    <form action="{{ route('admin.account.user.export.excel') }}">
                        <input type="hidden" name="search" value="{{ request()->search }}">
                        <button class="btn btn-success px-3">
                            <i class="fa fa-file-excel pr-2"></i>
                            <span class="float-right">Excel</span>
                        </button>
                        @if (request()->search)
                            <button type="button" class="btn btn-warning" onclick="return resetSearch()">Reset
                                Search</button>
                        @endif
                    </form>

                    <div class="ml-auto">
                        <form action="{{ route('admin.account.customer') }}">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control" name="search" value="{{ request()->search }}"
                                    placeholder="Search">
                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Avatar</th>
                                    <th>NRP</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration + $accounts->firstItem() - 1 }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td>
                                            @if ($account->email_verified_at == null)
                                                <span class="badge badge-danger">Belum Verifikasi Email</span>
                                            @else
                                                <span class="badge badge-success">Sudah Verifikasi Email</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty($account->avatar))
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/avatar/avatar-default.png') }}"
                                                    width="60" alt="avatar">
                                            @else
                                                <img class="rounded-circle" src="{{ $account->ImgProfile }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; object-position: center;"
                                                    alt="avatar">
                                            @endif
                                        </td>
                                        <td>{{ $account->nrp }}</td>
                                        <td><span class="badge badge-light">DILINDUNGI<span></td>
                                        <td>
                                            <!--@if ($account->email_verified_at != null && $account->role == 3)-->
                                            <!--    <div class="mb-2">-->
                                            <!--        <form action="'. route('admin.account.updaterole', $account->id) .'" method="post">-->
                                            <!--            @csrf-->
                                            <!--            @method("PATCH")-->
                                            <!--            <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i> UPDATE ROLE</button>-->
                                            <!--        </form>-->
                                            <!--    </div>-->
                                            <!--@endif-->
                                            <a href="{{ route('admin.account.register.edit', $account->id) }}"
                                                style="float: left;" class="mr-1"><i class="fa fa-pencil-square-o"
                                                    style="color: rgb(0, 241, 12);"></i></a>
                                            @include('alert.deleteUser')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center" class="bg-light">Data Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $accounts->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add data modal --}}
    {{-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('admin.account.register.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role" value="3">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="avatar">Image (Nullable):</label>
                                <input class="form-control" type="file" name="avatar" id="avatar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="name">Name:</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="your name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="email">E-Mail:</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="your email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pangkat_id">Pilih Pangkat:</label>
                                <select class="form-control custom-select" name="pangkat_id" id="pangkat_id">
                                    <option disabled selected>Pilih Pangkat</option>
                                    @foreach ($pangkats as $pangkat)
                                        <option value="{{ $pangkat->id }}">{{ $pangkat->pangkat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="nrp">NRP:</label>
                                <input class="form-control" type="number" name="nrp" id="nrp" placeholder="nrp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="password">Password:</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="********" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light for-light" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-secondary for-dark" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
        </div>
      </div> --}}
@endsection

@push('script')
    <script>
        function resetSearch() {
            window.location.href = '{{ route('admin.account.customer') }}'
        }
    </script>
@endpush

{{-- @push('style')
    <link rel="stylesheet" href="{{ asset('assets/js/datatable/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .dataTables_scroll {
            overflow:auto;
        }
    </style>
@endpush

@push('script')
    <script>
        function deleteUser(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan bisa mengembalikan data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Sedang menghapus User",
                            showConfirmButton: false,
                            timer: 2300,
                            timerProgressBar: true,
                            onOpen: () => {
                                document.getElementById(`DeleteUser${id}`).submit();
                                Swal.showLoading();
                            }
                        });
                    }
            })
        }
    </script>
@endpush

@push('datatable')
    <script src="{{ asset('assets/js/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        const dataUrl = '{{ route('admin.account.customer') }}'
        const csrf = '{{ csrf_token() }}'

        jQuery(function ($) {
            const table = $("table").DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: dataUrl,
                    type: "get",
                    error: (response) => {
                        console.log(response);
                    },
                },
                searching: true,
                columns: [
                    {
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: "name" },
                    { data: "email_verified_at" },
                    { data: "avatar" },
                    { data: "nrp" },
                    { data: "password", sortable: null, searchable: null },
                    { data: "action", sortable: false, searchable: false, },
                ],
            });

            const reload = () => table.ajax.reload();

            $('.dataTable').wrap('<div class="dataTables_scroll" />');

            $("#reload-data").click(function(){
                reload()
            })
        });
    </script>
@endpush --}}
