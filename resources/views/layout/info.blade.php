<div class="collapse show dash-content" id="dashtoggle">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Welcome !</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Welcome !</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- start dash info -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card dash-header-box shadow-none border-0">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-3 row-cols-md-3 row-cols-1 g-0">
                            <div class="col">
                                <div class="mt-md-0 py-3 px-4 mx-2">
                                    <p class="text-white-50 mb-2 text-truncate">Total Pengajuan </p>
                                    <h3 class="text-white mb-0">{{ $berkasCount }}</h3>
                                </div>
                            </div><!-- end col -->

                            <div class="col">
                                <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                    <p class="text-white-50 mb-2 text-truncate">Total Pengajuan Selesai</p>
                                    <h3 class="text-white mb-0">{{ $selesaiCount }}</h3>
                                </div>
                            </div><!-- end col -->

                            <div class="col">
                                <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                    <p class="text-white-50 mb-2 text-truncate">Total Pengajuan Ditolak</p>
                                    <h3 class="text-white mb-0">{{ $ditolakCount }}</h3>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end dash info -->
    </div>
</div>
