<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<style type="text/css">
		.bg-skyblue{
			background: skyblue;
			padding: 15px;
			color: white;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col text-center bg-skyblue mb-5">
				<h4>Pendaftaran</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php  
				if (@$this->session->flashdata('notif')) {
					echo $this->session->flashdata('notif');
					$this->session->unset_userdata('notif');
				}
				?>
			</div>
		</div>
		<form action="<?= site_url('Dashboard/action/') ?>" method="POST" enctype="multipart/form-data">
			<div class="row" style="background: #D3E4CD; padding: 1% 15%">
				<div class="col-6">
					<div class="mb-3">
						<label for="nama" class="form-label">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama" name="nama">
					</div>
					<div class="mb-3">
						<label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
						<input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">E-Mail</label>
						<input type="email" class="form-control" name="email" id="email">
					</div>
					<div class="mb-3">
						<label for="bank" class="form-label">Bank</label>
						<input type="text" class="form-control" name="bank" id="bank">
					</div>
					<div class="mb-3">
						<label for="tgl_transfer" class="form-label">Tanggal Transfer</label>
						<input type="date" class="form-control" name="tgl_transfer" id="tgl_transfer">
					</div>
				</div>
				<div class="col-6">
					<div class="mb-3">
						<label for="tmp_lahir" class="form-label">Tempat Lahir</label>
						<input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir">
					</div>
					<div class="mb-3">
						<label for="no_hp" class="form-label">Handphone</label>
						<input type="number" class="form-control" name="no_hp" id="no_hp">
					</div>
					<div class="mb-3">
						<label for="nominal" class="form-label">Nominal</label>
						<input type="number" class="form-control" name="nominal" id="nominal">
					</div>
					<div class="mb-3">
						<label for="an_bank" class="form-label">A.N Bank</label>
						<input type="text" class="form-control" name="an_bank" id="an_bank">
					</div>
					<div class="mb-3">
						<label for="gambar" class="form-label">&nbsp;</label>
						<input type="file" class="form-control" name="gambar" id="gambar" required="" onchange="loadFile(event)" accept="image/*">
						<img src="" alt="" class="img-thumbnail rounded mt-3" id="previewGambar">
					</div>
				</div>
				<div class="col text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script>
		var loadFile = function(event) {
			var avatar = document.getElementById('previewGambar');
			avatar.src = URL.createObjectURL(event.target.files[0]);
			avatar.onload = function() {
				URL.revokeObjectURL(avatar.src)
			}
		};
	</script>
</body>
</html>