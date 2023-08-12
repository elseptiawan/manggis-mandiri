<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Login | Manggis Mandiri</title>

	<link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Login</h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="/login" method="POST">
                                        {{ csrf_field() }}
                                        @if(session()->has('loginError'))
                                        <div class="error mb-3 bg-danger text-light p-2 rounded text-center">{{ session('loginError') }}</div>
                                        @endif
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Masukkan Email Anda" value="{{old('email')}}" />
										</div>
                                        @error('email')
                                            <div class="error mb-3 bg-danger text-light p-2 rounded">{{ $message }}</div>
                                        @enderror
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan Password Anda" />
										</div>
                                        @error('password')
                                            <div class="error mb-3 bg-danger text-light p-2 rounded">{{ $message }}</div>
                                        @enderror
										<div class="text-center mt-3">
                                            <input type="submit" class="btn btn-lg btn-primary" value="Login">
											{{-- <a href="index.html" class="btn btn-lg btn-primary">Login</a> --}}
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>