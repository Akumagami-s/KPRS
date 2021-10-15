@extends('layouts.basekpr')
@section('content')
    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">

                <div class="wrapperTable">
                    <h1 class="nameContent">Konfirmasi Pengajuan</h1>

                    <table id="tablePengajuan" class="table" style="width:100%">

                      <thead class="headTable">
                          <tr>
                            <th>Check</th>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Pangkat</th>
                            <th>Kesatuan</th>
                            <th>Pinjaman</th>
                            <th>Jangka Waktu</th>
                            {{-- <th>Aksi</th> --}}
                          </tr>
                      </thead>
                  </table>
                  <button id="approvePengajuan" class="btn btn-success">
                    Approve
            </button>
                </div>

            </div>



        </div>
      </div>
    <footer >
        <p>Copyright 2021 © DITKUAD</p>
    </footer>
    @endsection
    @push('script')
    <script>
        function confirmationUser(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin!',
                text: "Konfirmasi user ini untuk pengajuan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Sedang konfirmasi pengajuan...",
                        showConfirmButton: false,
                        timer: 2300,
                        timerProgressBar: true,
                        onOpen: () => {
                            document.getElementById(`ConfirmationUser${id}`).submit();
                            Swal.showLoading();
                        }
                    });
                }
            })
        }
    </script>
@endpush
@section('js')
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            tablepengajuan = $('#tablePengajuan').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "{{ route('tablePengajuan') }}",
                pageLength: 25,
                columns: [
                    {
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'nrp',
                        name: 'nrp',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'kesatuan',
                        name: 'kesatuan',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'pinjaman',
                        name: 'pinjaman',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'jk_waktu',
                        name: 'jk_waktu',
                        orderable: false,
                        searchable: true
                    },
                    // {
                    //     data: 'aksi',
                    //     name: 'aksi',
                    //     orderable: false,
                    //     searchable: true
                    // }
                    ],
                order: [
                    [1, 'asc']
                ]
            });
        });



        $('#approvePengajuan').on('click', function() {
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {


    var pengajuan_ids = [];
        $('.check-pengajuan:checked').each(function(k, d) {
            pengajuan_ids[k] = $(d).val();
        });




        if (pengajuan_ids.length) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("confirmation") }}',
                type: 'POST',
                data: {

                    pengajuan_ids: pengajuan_ids,

                },

                dataType: 'json',


                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        onRender: function() {

                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                success: function(response) {
                    tablepengajuan.ajax.reload();
                    Swal.fire({

  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
})

                }
            });
        } else {
            Swal.fire({
                // position: 'top-end',
                icon: 'error',
                title: 'Anda tidak memilih 1 pun pengajuan',
                showConfirmButton: false,
                timer: 1500
            })
        }






  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})

});


    </script>



@endsection
