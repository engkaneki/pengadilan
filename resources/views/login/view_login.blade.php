<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/app.css">
    <link rel="shortcut icon" href="{{ asset('/') }}assets/img/logo.png" type="image/x-icon">
    <title>Dukcapil Hadir di Pengadilan</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ url('login/proses') }}" method="post">
                @csrf

                <h1>Masuk</h1>
                <span>masuk halaman Pengadilan Negeri</span>
                <input autofocus type="text"
                    class="
                @error('username')
                    is-invalid
                @enderror"
                    name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror


                <input type="password"
                    class="
                @error('password')
                    is-invalid
                @enderror"
                    name="password" id="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit">Masuk</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{ url('login/proses') }}" method="post">
                @csrf

                <h1>Masuk</h1>
                <span>masuk halaman Pengadilan Agama</span>
                <input autofocus type="text"
                    class="
                @error('username')
                    is-invalid
                @enderror"
                    name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror


                <input type="password"
                    class="
                @error('password')
                    is-invalid
                @enderror"
                    name="password" id="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit">Masuk</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Pengadilan Agama</h1>
                    <p>untuk masuk ke halaman Pengadilan Agama klik disini!</p>
                    <button class="ghost" id="signIn">Masuk</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Pengadilan Negeri</h1>
                    <p>untuk masuk ke halaman Pengadilan Negeri klik disini!</p>
                    <button class="ghost" id="signUp">Masuk</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}assets/index.js"></script>
    <script src="{{ asset('/') }}assets/app.js"></script>
</body>

</html>
