@extends('layout.navbar')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">Data Berkas Pengajuan</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <form class="row gx-3 gy-2 align-items-center" method="GET">
                                    <div class="col-sm-5">
                                        <label class="visually-hidden" for="specificSizeInputName">Name</label>
                                        <input type="text" name="cari" id="cari" class="form-control"
                                            placeholder="Cari data berdasakan NIK/Nama Pelapor" value="{{ $cari }}">
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <thead>
                                <tr>
                                    <th style="width: 2%">No</th>
                                    <th style="width: 10%">@sortablelink('nik', 'NIK')</th>
                                    <th style="width: 15%">@sortablelink('nama', 'Nama')</th>
                                    <th style="width: 20%">@sortablelink('created_at', 'Tanggal Pengajuan')</th>
                                    <th style="width: 30%">@sortablelink('alamat', 'Alamat')</th>
                                    <th style="width: 25%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1 + ($Berkas->currentPage() - 1) * $Berkas->perPage();
                                @endphp
                                @foreach ($Berkas as $d)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->created_at->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $d->id }}">Detail</button>
                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $d->id }}">Edit</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $d->id }}">Hapus</button>


                                            {{-- Modal Detail --}}
                                            <div class="modal fade " id="detail{{ $d->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                                                    <form class="modal-content" method="POST"
                                                        action="{{ url('pengajuan/edit') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('GET')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Detail
                                                                berkas {{ $d->nama }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">NIK</label>
                                                                    <input type="number" class="form-control"
                                                                        name="nik" id="nik"
                                                                        value="{{ $d->nik }}" readonly>
                                                                    <input type="number" class="form-control"
                                                                        name="id" id="id"
                                                                        value="{{ $d->id }}" readonly
                                                                        hidden="true">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" value="{{ $d->nama }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" readonly>{{ $d->alamat }}</textarea>
                                                            </div>
                                                            <h3>
                                                                Berkas Persyaratan
                                                            </h3>
                                                            <div class="mb-3">
                                                                <label class="form-label">KTP</label>
                                                                @if ($d->ktp)
                                                                    <img src="{{ asset('storage/' . $d->ktp) }}"
                                                                        class="img-thumbnail" style="width: 50%">
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">KTP
                                                                        kosong</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kartu Keluarga</label>
                                                                @if ($d->kk)
                                                                    <img src="{{ asset('storage/' . $d->kk) }}"
                                                                        class="img-thumbnail" style="width: 50%">
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">Kartu
                                                                        Keluarga kosong</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Akta Cerai</label>
                                                                @if ($d->akta)
                                                                    <img src="{{ asset('storage/' . $d->akta) }}"
                                                                        class="img-thumbnail" style="width: 50%">
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">Akta Cerai
                                                                        kosong</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- end modalbody -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            {{-- end Modal Detail --}}

                                            {{-- Modal Edit --}}
                                            <div class="modal fade " id="edit{{ $d->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                                                    <form class="modal-content" method="POST"
                                                        action="{{ url('pengajuan/edit') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('GET')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit
                                                                berkas {{ $d->nama }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">NIK</label>
                                                                    <input type="number" class="form-control"
                                                                        name="nik" id="nik"
                                                                        value="{{ $d->nik }}">
                                                                    <input type="number" class="form-control"
                                                                        name="id" id="id"
                                                                        value="{{ $d->id }}" readonly
                                                                        hidden="true">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" value="{{ $d->nama }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{ $d->alamat }}</textarea>
                                                            </div>
                                                            <h3>
                                                                Berkas Persyaratan
                                                            </h3>
                                                            <div class="mb-3">
                                                                <label class="form-label">KTP</label>
                                                                @if ($d->ktp)
                                                                    <img src="{{ asset('storage/' . $d->ktp) }}"
                                                                        class="img-thumbnail" style="width: 50%">
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">KTP
                                                                        kosong</span>
                                                                @endif

                                                                <input name="ktp" id="ktp" type="file"
                                                                    class="form-control" accept="image/*">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kartu Keluarga</label>
                                                                @if ($d->kk)
                                                                    <img src="{{ asset('storage/' . $d->kk) }}"
                                                                        class="img-thumbnail" style="width: 50%">
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">Kartu
                                                                        Keluarga kosong</span>
                                                                @endif

                                                                <input name="kk" id="kk" type="file"
                                                                    class="form-control" accept="image/*">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Akta Cerai</label>
                                                                @if ($d->akta)
                                                                    <img src="{{ asset('storage/' . $d->akta) }}"
                                                                        class="img-thumbnail" style="width: 50%">
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">Akta Cerai
                                                                        kosong</span>
                                                                @endif

                                                                <input name="akta" id="akta" type="file"
                                                                    class="form-control" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <!-- end modalbody -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            {{-- end Modal Edit --}}

                                            {{-- Modal Hapus --}}
                                            <div class="modal fade " id="hapus{{ $d->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                                                    <form class="modal-content" method="POST"
                                                        action="{{ url('pengajuan/hapus') }}/{{ $d->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Hapus berkas</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Menghapus berkas atas nama {{ $d->nama }}
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
                        {{-- {{ $Berkas->links() }} --}}
                        {!! $Berkas->appends(Request::except('page'))->render() !!}
                    </div><!-- end table responsive -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="modal fade " id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
            <form class="modal-content" method="POST" action="{{ url('pengajuan/simpan') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Buat Pengajuan Berkas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="number"
                                class="form-control @error('nik')
                                is-invalid
                            @enderror"
                                name="nik" id="nik" placeholder="Masukkan NIK Pelapor"
                                value="{{ old('nik') }}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text"
                            class="form-control @error('nama')
                            is-invalid
                        @enderror"
                            name="nama" id="nama" placeholder="Masukkan Nama Pelapor"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10"
                            class="form-control @error('alamat')
                            is-invalid
                        @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <h3>
                        Berkas Persyaratan
                    </h3>
                    <div class="mb-3">
                        <label class="form-label">KTP</label>
                        <input type="file"
                            class="form-control @error('ktp')
                            is-invalid
                        @enderror"
                            name="ktp" id="ktp" value="{{ old('ktp') }}" accept="image/*">
                        @error('ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kartu Keluarga</label>
                        <input type="file" name="kk" id="kk"
                            class="form-control @error('kk')
                            is-invalid
                        @enderror"
                            accept="image/*">
                        @error('kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Akta Cerai</label>
                        <input type="file" name="akta" id="akta"
                            class="form-control @error('akta')
                            is-invalid
                        @enderror"
                            accept="image/*">
                        @error('akta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- end modalbody -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
