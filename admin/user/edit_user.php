<?php
$id=$_GET['id'];
$sql="SELECT * FROM tb_user WHERE id_user='$id'";
$query=mysql_query($sql) or die(mysql_error());
$data=mysql_fetch_array($query);

if (isset($_POST['simpan'])) 
{
  $id_user = $_POST['id_user'];
  $nik = $_POST['nik'];
  $nama = $_POST['nama'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $foto  = $id_user.'_'.$_FILES["foto"]["name"];
  $foto_cek  = $_FILES["foto"]["name"];
  $status = $_POST['status'];

  if ($foto_cek == "") 
  {
    $simpan = mysql_query("UPDATE tb_user SET nik='$nik', nama='$nama', jekel='$jekel', alamat='$alamat', 
    no_hp='$no_hp', username='$username', password='$password', status='$status' WHERE id_user='$id'") or die(mysql_error());
  }else 
  {
    $sql1 = mysql_query("select foto from tb_user where id_user='$id_user'") or die (mysql_error());
    $folder = mysql_fetch_array($sql1);
    $tempat = $folder['foto'];
    $imagedelet = "../foto/user/$tempat";
    unlink($imagedelet);
    $pindah = move_uploaded_file($sumber, $target.$foto);
    $simpan = mysql_query("UPDATE tb_user SET nik='$nik', nama='$nama', jekel='$jekel', alamat='$alamat', 
    no_hp='$no_hp', username='$username', password='$password', foto='$foto', status='$status' WHERE id_user='$id'") or die(mysql_error());
  }

  if ($simpan) 
  {
    echo "<div class='alert alert-success'>
    <a href='?page=data_user' class='close' data-dismiss='alert'>
    &times;
    </a> Edit Data Berhasil
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";

  }else
  {
    echo "<div class='alert alert-success'>
    <a href='?page=data_user' class='close' data-dismiss='alert'>
    &times;
    </a> Edit Data Gagal
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
  } 
}

?>
<div class="right_col" role="main">
<section class="content-header">
      <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit User</h3>
              </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box-header with-border">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Silahkan isi data dengan benar</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"></div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID User</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_user" value="<?php echo $data['id_user']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?php echo $data['nik']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jekel">
                      <option value="L">Laki-laki</option>
                      <option value="P"  <?php if ($data['jekel']=="P") {echo 'selected';} ?>>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"><?php echo $data['alamat']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" placeholder="Nomer HP" value="<?php echo $data['no_hp']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" placeholder="Pilih Username Anda" value="<?php echo $data['username']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="password" placeholder="ganti password" value="<?php echo $data['password']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" id="exampleInputFile" name="foto">
                    <br>
                    <label><?php echo $data['foto'] ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="status">
                      <option> <?php echo $data['status']; ?></option>
                      <option value="petugas">Petugas</option>
                      <option value="kabid">Kepala Bidang</option>
                      <option value="kadin">Kepala Dinas</option> -->
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="?page=data_user" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right" name="simpan">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>