@extends('layout.navbar')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            <img src="{{ asset('/') }}img/bg.jpg" class="profile-img profile-foreground-img rounded-top"
                                style="height: 120px;" alt="">
                        </div>
                        <!-- end user-profile-img -->

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-n5 position-relative">
                                <div class="text-center">
                                    <label for="upload-avatar">
                                        <img src="{{ asset('/') }}assets/images/users/admin_killua.jpg" alt=""
                                            class="avatar-xl rounded-circle img-thumbnail" id="avatar-preview">
                                        <div class="py-2 text-center">
                                            <button type="button"
                                                class="btn btn-secondary btn-sm position-absolute start-50 translate-middle"
                                                id="upload-avatar-btn">
                                                <span class="bx bx-camera"></span>
                                            </button>
                                        </div>
                                    </label>
                                    <input type="file" class="d-none" id="upload-avatar" name="avatar">
                                    <div class="mt-3">
                                        <h5 class="mb-1">{{ $user->name }}</h5>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Upload Photo</button>
                        </form>


                        <script>
                            const avatarPreview = document.getElementById('avatar-preview');
                            const uploadAvatarBtn = document.getElementById('upload-avatar-btn');
                            const uploadAvatarInput = document.getElementById('upload-avatar');

                            uploadAvatarBtn.addEventListener('click', () => {
                                uploadAvatarInput.click();
                            });

                            uploadAvatarInput.addEventListener('change', () => {
                                const file = uploadAvatarInput.files[0];
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = () => {
                                        avatarPreview.src = reader.result;
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    alert('Please select an image file.');
                                }
                            });
                        </script>



                        <div class="p-4 mt-2">
                            <h5 class="font-size-16">Info :</h5>

                            <div class="mt-4">
                                <p class="text-muted mb-1">Name :</p>
                                <h5 class="font-size-14 text-truncate">{{ $user->name }}</h5>
                            </div>

                            <div class="mt-4">
                                <p class="text-muted mb-1">E-mail :</p>
                                <h5 class="font-size-14 text-truncate">{{ $user->email }}</h5>
                            </div>

                            <div class="mt-4">
                                <p class="text-muted mb-1">Alamat :</p>
                                <h5 class="font-size-14 text-truncate">{{ $user->alamat }}</h5>
                            </div>
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end col -->

            <div class="col-xxl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Setting</h5>
                        <form method="POST" action="{{ url('profile/update') }}">
                            @csrf
                            @method('POST')
                            <div class="card border shadow-none mb-5">
                                <div class="card-header d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">General Info</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        value="{{ $user->username }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="nama"
                                                        placeholder="Masukkan Nama" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Masukkan Email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Handphone</label>
                                                    <input type="number" class="form-control" name="no_hp"
                                                        placeholder="Masukkan Nomor Handphone" value="{{ $user->no_hp }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" rows="3">{{ $user->alamat }}</textarea>
                                        </div>
                                        <div class="form-check mb-3" data-bs-toggle="collapse"
                                            data-bs-target="#collapseChangePassword" aria-expanded="false"
                                            aria-controls="collapseChangePassword">
                                            <input type="checkbox" class="form-check-input" id="gen-info-change-password"
                                                name="change_password">
                                            <label class="form-check-label" for="gen-info-change-password">Ganti
                                                password?</label>
                                        </div>
                                        <div class="collapse" id="collapseChangePassword">
                                            <div class="card border shadow-none card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-lg-0">
                                                            <label for="current-password-input"
                                                                class="form-label">password
                                                                sekarang</label>
                                                            <input type="password" class="form-control"
                                                                name="current_password"
                                                                placeholder="Masukkan password sekarang"
                                                                id="current-password-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-lg-0">
                                                            <label for="new-password-input" class="form-label">password
                                                                baru</label>
                                                            <input type="password" class="form-control"
                                                                name="new_password" placeholder="Masukkan password baru"
                                                                id="new-password-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-lg-0">
                                                            <label for="confirm-password-input"
                                                                class="form-label">konfirmasi password baru</label>
                                                            <input type="password" class="form-control"
                                                                name="new_password_confirmation"
                                                                placeholder="Masukkan konfirmasi password baru"
                                                                id="confirm-password-input">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($errors->has('current_password'))
                                            <div class="alert alert-danger">{{ $errors->first('current_password') }}</div>
                                        @endif
                                        @if ($errors->has('new_password'))
                                            <div class="alert alert-danger">{{ $errors->first('new_password') }}</div>
                                        @endif

                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Update Profil</button>
                                </div>
                            </div>

                        </form>

                        <!-- end form -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
@endsection
