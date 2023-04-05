@extends('layout.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-2">Berkas Bulan Maret 2023</h5>
                            </div>
                        </div>

                        <div id="chart-donut" data-colors='["--bs-info", "--bs-success","--bs-danger"]' class="apex-charts"
                            dir="ltr"></div>

                        <div class="mt-1 px-2">
                            <div class="order-wid-list d-flex justify-content-between border-bottom">
                                <p class="mb-0"><i
                                        class="mdi mdi-square-rounded font-size-10 text-info me-2"></i>Pengajuan
                                    Diproses
                                </p>
                                <div>
                                    <span class="pe-5">20</span>
                                </div>
                            </div>
                            <div class="order-wid-list d-flex justify-content-between border-bottom">
                                <p class="mb-0"><i
                                        class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Pengajuan
                                    Selesai</p>
                                <div>
                                    <span class="pe-5">12</span>
                                </div>
                            </div>
                            <div class="order-wid-list d-flex justify-content-between">
                                <p class="mb-0"><i
                                        class="mdi mdi-square-rounded font-size-10 text-danger me-2"></i>Pengajuan
                                    Ditolak</p>
                                <div>
                                    <span class="pe-5">3</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-2">Pengajuan Terakhir</h5>
                            </div>
                        </div>

                        <div class="">
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap align-middle table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 210px">Nama Pelapor</th>
                                            <th scope="col" style="width: 300px">Nomor Registrasi</th>
                                            <th scope="col">Tanggal Pengajuan</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">Manusia 1</div>
                                                </div>
                                            </td>
                                            <td>1219/pa/03032023/001</td>
                                            <td>
                                                <span>03 Maret 2023</span>
                                            </td>
                                            <td>
                                                <div class="flex-grow-1">Selesai</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">Manusia 2</div>
                                                </div>
                                            </td>
                                            <td>1219/pa/03032023/002</td>
                                            <td>
                                                <span>03 Maret 2023</span>
                                            </td>
                                            <td>
                                                <div class="flex-grow-1">Diproses</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">Manusia 3</div>
                                                </div>
                                            </td>
                                            <td>1219/pa/03032023/003</td>
                                            <td>
                                                <span>03 Maret 2023</span>
                                            </td>
                                            <td>
                                                <div class="flex-grow-1">Diproses</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">Manusia 4</div>
                                                </div>
                                            </td>
                                            <td>1219/pa/03032023/004</td>
                                            <td>
                                                <span>03 Maret 2023</span>
                                            </td>
                                            <td>
                                                <div class="flex-grow-1">Selesai</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">Manusia 5</div>
                                                </div>
                                            </td>
                                            <td>1219/pa/03032023/005</td>
                                            <td>
                                                <span>03 Maret 2023</span>
                                            </td>
                                            <td>
                                                <div class="flex-grow-1">Ditolak</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
