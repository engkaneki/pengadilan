@extends('layout.navbar')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">Daftar Pengguna</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card">
                            <div class="card-body">
                                <form class="row gx-3 gy-2 align-items-center" method="GET">
                                    <div class="col-sm-5">
                                        <label class="visually-hidden" for="specificSizeInputName">Name</label>
                                        <input type="text" name="cari" id="cari" class="form-control"
                                            placeholder="Cari pengguna berdasarkan Nama" value="{{ $cari }}">
                                    </div>
                                    <!-- end col -->
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-info">Cari</button>
                                    </div>
                                    <!-- end col -->
                                </form><!-- end form -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 2%">No</th>
                                    <th style="width: 20%">Nama</th>
                                    <th style="width: 10%">Email</th>
                                    <th style="width: 10%">No. Hp</th>
                                    <th style="width: 30%">Alamat</th>
                                    <th style="width: 10%">Foto</th>
                                    <th style="width: 18%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1 + ($Users->currentPage() - 1) * $Users->perPage();
                                @endphp
                                @foreach ($Users as $d)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->no_hp }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td><img src="{{ asset('storage/' . $d->photo) }}" alt="" class="avatar-lg"
                                                style="object-fit: contain;">
                                        </td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#reset{{ $d->id }}">Reset</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $d->id }}">Hapus</button>


                                            {{-- Modal Reset --}}
                                            <div class="modal fade " id="reset{{ $d->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                                                    <form class="modal-content" method="POST"
                                                        action="{{ url('users/reset') }}">
                                                        @csrf
                                                        @method('GET')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Reset password</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Reset Password {{ $d->name }}
                                                                <strong>?</strong>
                                                            </h5>
                                                            <input type="text" value="{{ $d->id }}"
                                                                name="id" hidden="true">
                                                        </div>
                                                        <!-- end modalbody -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Reset</button>
                                                        </div>
                                                    </form><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            {{-- end Modal Reset --}}

                                            {{-- Modal Hapus --}}
                                            <div class="modal fade " id="hapus{{ $d->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                                                    <form class="modal-content" method="POST"
                                                        action="{{ url('users/hapus') }}/{{ $d->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Hapus akun</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Menghapus akun atas nama {{ $d->name }}
                                                                <strong>?</strong>
                                                            </h5>
                                                        </div>
                                                        <!-- end modalbody -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Hapus</button>
                                                        </div>
                                                    </form><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            {{-- end Modal Hapus --}}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                        {{-- {{ $Users->links() }} --}}
                        {!! $Users->appends(Request::except('page'))->render() !!}
                    </div><!-- end table responsive -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
