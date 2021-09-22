@extends('layouts.app', ['title' => 'KPR | Data Fasilitas'])
@section('dashboard', 'DATA FASILITAS')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.partials.error')
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary btn-md">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @forelse ($data as $fasilitas)
                                <tbody>
                                    <tr>
                                        <th>{{ $loop->iteration + $data->firstItem() - 1 . '.' }}</th>
                                        <td>{{ $fasilitas->nama_fasilitas }}</td>
                                        <td>
                                            <a href="{{ route('admin.fasilitas.edit', $fasilitas->id) }}"
                                                style="float: left;" class="mr-1"><i class="fa fa-pencil-square-o"
                                                    style="color: rgb(0, 241, 12);"></i></a>
                                            <button type="submit" onclick="deleteFasilitas('{{ $fasilitas->id }}')"
                                                style="background-color: transparent; border: none;"><i
                                                    class="icon-trash" style="color: red;"></i></button>
                                            <form action="{{ route('admin.fasilitas.destroy', $fasilitas->id) }}"
                                                method="post" id="DeleteFasilitas{{ $fasilitas->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <script>
                                                function deleteFasilitas(id) {
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
                                                                title: "Sedang menghapus Fasilitas",
                                                                showConfirmButton: false,
                                                                timer: 2300,
                                                                timerProgressBar: true,
                                                                onOpen: () => {
                                                                    document.getElementById(
                                                                        `DeleteFasilitas${id}`).submit();
                                                                    Swal.showLoading();
                                                                }
                                                            });
                                                        }
                                                    })
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <tbody>
                                    <tr>
                                        <th colspan="3" style="color: red; text-align: center;">Data Empty!</th>
                                    </tr>
                                </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
