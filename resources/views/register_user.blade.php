<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login User</title>

    <!-- Google Fonts -->
    <link href="{{asset('https://fonts.gstatic.com')}}" rel="preconnect">
    <link
        href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{asset('assets/user/img/logo.png')}}" alt="">
                                    <span class="d-none d-lg-block">Login User</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Masjid Abdullah</h5>
                                        <p class="text-center small">Welcome to Sistem Informasi Masjid Abdullah</p>
                                        <p class="text-center small">Silahkan membuat akun terlebih dahulu untuk
                                            menikmati
                                            fitur - fitur yang telah disediakan</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{route('prosesRegister')}}"
                                        method="POST" enctype="multipart/form-data" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">NAMA</label>
                                            <input type="text" name="nama_lengkap"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="yourName" value="{{old('nama_lengkap')}}">
                                            @error('nama_lengkap')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">USERNAME</label>
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="yourEmail" value="{{old('username')}}">
                                            @error('username')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">EMAIL</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="yourEmail" value="{{old('email')}}">
                                            @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">NOMOR TELEPHONE</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="nomor_telp" maxlength="12" min="0"
                                                    class="form-control @error('nomor_telp') is-invalid @enderror"
                                                    id="nomor_telp" value="{{old('nomor_telp')}}">
                                                @error('nomor_telp')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">PASSWORD</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-eye" id="eye"></i>
                                                </span>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" value="{{old('password')}}">
                                                @error('password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 row mt-3">
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                        id="inlineRadio1" value="Pria"
                                                        {{old('jenis_kelamin') === 'Pria' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="inlineRadio1">Pria</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                        id="inlineRadio2" value="Wanita"
                                                        {{old('jenis_kelamin') === 'Wanita' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="inlineRadio2">Wanita</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 row mt-3">
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status_warga"
                                                        id="pj" value="PJ" {{old('status_warga') === 'PJ' ? 'checked' : ''}}
                                                        onchange="uploadBuktiKTP()">
                                                    <label class="form-check-label" for="inlineRadio1">Warga PJ</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status_warga"
                                                        id="non_pj" value="Non"
                                                        {{old('status_warga') === 'Non' ? 'checked' : ''}}
                                                        onchange="uploadBuktiKTP()">
                                                    <label class="form-check-label" for="inlineRadio2">Warga Non
                                                        PJ</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12" @if (old('status_warga') == 1) style="display: block" @else
                                            style="display: none" @endif id="bukti_ktp">
                                            <label for="yourUsername" class="form-label">Bukti KTP</label>
                                            <div class="input-group has-validation">
                                                <input type="file" name="bukti_status_warga"
                                                    class="form-control @error('bukti_status_warga') is-invalid @enderror"
                                                    id="bukti_gambar" onchange="previewImage()" value="{{old('bukti_ktp')}}">

                                                @error('bukti_status_warga')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <img class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{route('loginUser')}}">Log in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
        </div>

        </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/user/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/user/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/user/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('assets/user/js/main.js')}}"></script>

    <script>
        let eyeIcon = document.getElementById("eye");
        let pw = document.getElementById("password");

        eyeIcon.onclick = function () {
            if (pw.type == "password") {
                pw.type = "text";
            } else {
                pw.type = "password";
            }
        }

        function previewImage() {
            const image = document.querySelector('#bukti_gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function uploadBuktiKTP() {
            const wargaPJ = document.getElementById('pj').checked;
            const wargaNonPJ = document.getElementById('non_pj').checked;

            if (wargaPJ === true) {
                document.getElementById('bukti_ktp').style.display = 'block';
            } else if (wargaNonPJ === true) {
                document.getElementById('bukti_ktp').style.display = 'none';
            }
        }

        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.oninput = () => {
                if (input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            };
        });

    </script>

</body>

</html>
