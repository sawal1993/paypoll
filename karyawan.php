<?php include"header.php";?>

<br/>
<br/>
<br/>


<?php 
$view =isset($_GET['view']) ? $_GET['view'] :null;
switch ($view) {
default:
?>
<!-- menampilkan pesan -->


<div class="row m-t-8">

<div class="col-md-12">
<div class="table-responsive m-b-50">


<style type="text/css">
th{
font-size: 12px;
text-align: center;s
}
td{
font-size: 12px;
}
</style>
<div class="card-body" >
 <?php
if(isset($_GET['e']) && $_GET['e']=='sukses'){
?>
<div class="alert alert-success" role="alert" style="margin-top: 30px">
Selamat <strong>Proses Berhasil</strong>
</div>

<?php
}else if(isset($_GET['e']) && $_GET['e']=='gagal'){
?>
<div class="alert alert-danger" role="alert"  style="margin-top: 30px">
Error <strong>Proses Gagal</strong>
</div>

<?php
}
?>
<a href="karyawan.php?view=tambah" class="btn btn-primary" style="float: right; margin-right: 30px ; margin-top: 40px" >Tambah Data Karyawan</a>
<table  class="table " border="0" >
</div>
<thead>
<tr>

<th align='center'>No</th>
<th align='center'>Id</th>
<th align='center'>Nama Karyawan</th>
<th align='center'>Card Number</th>
<th align='center'>Jabatan</th>
<th align='center'>Status</th>
<th align='center'>Tempat Jabatan</th>
<th align='center'>Tanggal Masuk</th>
<th align='center'>Tanggal Keluar</th>
<th align='center'>BPJS Kesehatan</th>
<th align='center'>BPJS Ketenagakerjaan</th>
<th align='center' colspan="3" style="width: auto;">Aksi</th>                                                                                                
</tr>
</thead>

<?php
$sql = mysqli_query($konek,"select * from karyawans ");
$no=1;
while($d= mysqli_fetch_array($sql)){
     if($d['tglKeluar'] == '0000-00-00'){
          $blm = 'Belum keluar';
     }else {
          $blm =$d['tglKeluar'];
     }
echo 
"<tr>
<td width='40px' align='center'>$no</td>
<td align='center'>$d[id]</td>
<td align='center'>$d[nama]</td>
<td align='center'>$d[CardNumber]</td>
<td align='center'>$d[jabatan]</td>
<td align='center'>$d[status]</td>
<td align='center'>$d[tempatJabatan]</td>
<td align='center'>$d[tglMasuk]</td>
<td align='center'>$blm</td>
<td align='center'>$d[bpjsKes]</td>
<td align='center'>$d[bpjsKet]</td>
<td width='2px'>
<a class='btn btn-warning btn-sm fa fa-edit' href='karyawan.php?view=edit&id=$d[id]' ></a></td>
<td width='2px' ><a class='btn btn-danger btn-sm fa fa fa-eraser' href='aksi_karyawan.php?act=del&id=$d[id]'></a></td>
<td width='2px' ><a class='btn btn-primary btn-sm' href='karyawan.php?view=resign&id=$d[id]'>resign</a>
</td>
</tr>";
$no++;
}
?>
</table>
<tbody>

</div>
</div>
</div>
</div>


<?php
break;
case "tambah";  
$query = "SELECT max(id) as id FROM karyawans";
$hasil = mysqli_query($konek,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['id'];
$noUrut = (int) substr($kodeBarang, 3, 3);
$noUrut++;
$char = "K";
$kodeBarang = $char . sprintf("%03s", $noUrut);
?>
<?php
if(isset($_GET['e']) && $_GET['e']=='bl'){
 ?>
<div class="alert alert-danger" role="alert">
Peringatan<strong>Form Belum Lengkap</strong>
</div>


 <?php
}
?>
<section class="au-breadcrumb m-t-75">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="au-breadcrumb-content">
<div class="au-breadcrumb-left">
<span class="au-breadcrumb-span">You are here:</span>
<ul class="list-unstyled list-inline au-breadcrumb__list">
<li class="list-inline-item active">
<a href="#">Dashboard</a>
</li>
<li class="list-inline-item seprate">
<span>/</span>
</li>
<li class="list-inline-item">Tambah Karyawan</li>

</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<br>
<div class="col-lg-11">
<div class="card">
<div class="card-header">
<strong>Karyawan</strong>
<small> Tambah</small>

</div>
<div style='margin-left:30px;'>
<div class="card-body card-block row">
<form method="post" action="aksi_karyawan.php?act=insert" class="form-horizontal">
</div>
<table  width="900px">

<tr>
<td>
<div class="form-group">
<label for="id" class=" form-control-label">Id Karyawan</label>
<input type="text" value="<?php echo $kodeBarang; ?>" name="id" placeholder="Masukkan ID Karyawan" class="form-control"style="width: 400px" readonly>
</div>
</td>
<td> 
<div class="form-group">
<label for="nama" class=" form-control-label">Nama Karyawan</label>
<input type="text" name="nama" placeholder="Masukkan Nama Karyawan" class="form-control"style="width: 400px" >
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="CardNumber" class=" form-control-label">Card Id</label>
<input type="text" name="CardNumber"  placeholder="Masukkan Card Id Anda" class="form-control"style="width: 400px" >
</div>
</td>
<td> 
<div class="form-group">
<label for="jabatan" class=" form-control-label">Jabatan</label>
<select name="jabatan"  class="form-control-sm form-control"  style="width: 400px">
<option value="" selected="selected">-</option>
<?php
// query untuk menampilkan semua mata pelajaran dari tabel 
$query = "SELECT * FROM jabatan";
$hasil = mysqli_query($konek,$query);
while ($data = mysqli_fetch_array($hasil))
{
echo "<option value='".$data['id']."'>".$data['namajabatan']."</option>";
}
?>
 </select>
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="status" class=" form-control-label">Status</label>
<select name="status"  class="form-control-sm form-control" style="width: 400px">
     <option value="0">Please select</option>
     <option value="TETAP">TETAP</option>
     <option value="KONTRAK">KONTRAK</option>
 </select>
</div>
</div>
</td>
<td>
<div class="form-group">
<label for="tempatJabatan" class=" form-control-label">Tempat Jabatan</label>
<select name="tempatJabatan"  class="form-control-sm form-control" style="width: 400px">
     <option value="0">Please select</option>
     <option value="SD">SD</option>
     <option value="SMP">SMP</option>
      <option value="SMA">SMA</option>
 </select>
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="tglMasuk" class=" form-control-label">Tanggal Masuk</label>
<input type="date" name="tglMasuk"  placeholder="Masukkan Tanggal Masuk Anda" class="form-control"style="width: 400px" >
</div>
</td>
<td>
<div class="form-group">
<input type="date" name="tglKeluar"  placeholder="Masukkan Tanggal Keluar Anda" hidden class="form-control"style="width: 400px" >
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="bpjsKes" class=" form-control-label">BPJS Kesehatan</label>
<input type="number" name="bpjsKes"  placeholder="Masukkan bpjsKesesehatan Anda" class="form-control"style="width: 400px" >
</div>
</td>
<td>
<div class="form-group">
<label for="bpjsKet" class=" form-control-label">BPJS Ketenagakerjaan</label>
<input type="number" name="bpjsKet"  placeholder="Masukkan bpjs Ketenagakerjaan Anda" class="form-control"style="width: 400px ">
</div>
</td>
</tr>
</table>
<div class="card-body">
<input type="submit" class="btn btn-primary" value="simpan">
<a class="btn btn-danger" href="karyawan.php">kembali</a>

</div>
</div>
</div>
</form>
</div>
<?php
break;
case "edit";
$sqlEdit = mysqli_query($konek,"select * from karyawans where id='$_GET[id]'");
$e = mysqli_fetch_array($sqlEdit);
$query = "SELECT max(id) as id FROM karyawans";
$hasil = mysqli_query($konek,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['id'];
$noUrut = (int) substr($kodeBarang, 3, 3);
$noUrut++;
$char = "K";
$kodeBarang = $char . sprintf("%03s", $noUrut);
?>
<section class="au-breadcrumb m-t-75">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="au-breadcrumb-content">
<div class="au-breadcrumb-left">
<span class="au-breadcrumb-span">You are here:</span>
<ul class="list-unstyled list-inline au-breadcrumb__list">
<li class="list-inline-item active">
<a href="#">Dashboard</a>
</li>
<li class="list-inline-item seprate">
<span>/</span>
</li>
<li class="list-inline-item">Edit Karyawan</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<br>
<div class="col-lg-11">
<div class="card">
<div class="card-header">
<strong>Karyawan</strong>
<small> edit</small>

</div>
<div style='margin-left:30px;'>
<div class="card-body card-block row">
<form action="aksi_karyawan.php?act=update" method="post" class="form-horizontal">
</div>
<table  width="900px">

<tr>
<td>
<div class="form-group">
<label for="id" class=" form-control-label">Id Karyawan</label>
<input type="text" value="<?php echo $e['id']; ?>" name="id" placeholder="Masukkan ID Karyawan" class="form-control"style="width: 400px" readonly>
</div>
</td>
<td> 
<div class="form-group">
<label for="nama" class=" form-control-label">Nama Karyawan</label>
<input type="text" name="nama" value="<?php echo $e['nama']?>" placeholder="Masukkan Nama Karyawan" class="form-control"style="width: 400px">
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="CardNumber" class=" form-control-label">Card Id</label>
<input type="text" name="CardNumber" value="<?php  echo $e['CardNumber']?>" placeholder="Masukkan Card Id Anda" class="form-control"style="width: 400px" >
</div>
</td>
<td> 
<div class="form-group">
<label for="jabatan" class=" form-control-label">Jabatan</label>
<select name="jabatan" class="form-control-sm form-control" style="width: 400px">
     <?php
       $query_jurusan="SELECT * FROM jabatan";
       $sql_jurusan=mysqli_query($konek,$query_jurusan);
       while ($data_jurusan=mysqli_fetch_array($sql_jurusan)) {
        if ($data['namajabatan']==$data_jurusan['id']) {
         $select="selected";
        }else{
         $select="";
        }
        echo "<option $select>".$data_jurusan['namajabatan']."</option>";
       }
      ?>      
    <!--  -->
 </select>
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="status" class=" form-control-label">Status</label>
<select name="status"  class="form-control-sm form-control" style="width: 400px">
   <?php $statuss = $e['status']; ?>
     <option <?php echo ($statuss == 'TETAP') ? "selected": "" ?>>TETAP</option>
     <option <?php echo ($statuss == 'KONTRAK') ? "selected": "" ?>>KONRAK</option>
 </select>
</div>
</div>
</td>
<td>
<div class="form-group">
<label for="tempatJabatan" class=" form-control-label">Tempat Jabatan</label>
<select name="tempatJabatan"  class="form-control-sm form-control" style="width: 400px">
     <?php $jab = $e['tempatJabatan']; ?>
     <option <?php echo ($jab == 'SD') ? "selected": "" ?>>SD</option>
     <option <?php echo ($jab == 'SMP') ? "selected": "" ?>>SMP</option>
     <option <?php echo ($jab == 'SMA') ? "selected": "" ?>>SMA</option> 
 </select>
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="tglMasuk" class=" form-control-label">Tanggal Masuk</label>
<input type="date" name="tglMasuk" value="<?php  echo $e['tglMasuk']?>"  placeholder="Masukkan Tanggal Masuk Anda" class="form-control"style="width: 400px" >
</div>
</td>
<td>
<div class="form-group">
<!-- <label for="tglKeluar" class=" form-control-label">Tanggal Keluar</label> -->
<input type="date" name="tglKeluar" value="<?php  echo $e['tglKeluar']?>" hidden placeholder="Masukkan Tanggal Keluar Anda" class="form-control"style="width: 400px" >
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="bpjsKes" class=" form-control-label">BPJS Kesehatan</label>
<input type="number" name="bpjsKes" value="<?php echo $e['bpjsKes']; ?>" placeholder="Masukkan bpjsKesesehatan Anda" class="form-control"style="width: 400px" >
</div>
</td>
<td>
<div class="form-group">
<label for="bpjsKet" class=" form-control-label">BPJS Ketenagakerjaan</label>
<input type="number" name="bpjsKet" value="<?php echo $e['bpjsKet']; ?>" placeholder="Masukkan bpjs Ketenagakerjaan Anda" class="form-control"style="width: 400px" >
</div>
</td>
</tr>
</table>
<div class="card-body">
<input type="submit" class="btn btn-primary " value="Simpan">
<a class="btn btn-danger" href="karyawan.php">kembali</a>
</div>
</div>
</div>
</form>
</div>

}
?>
<?php
break;
case "resign";
$sqlEdit = mysqli_query($konek,"select * from karyawans where id='$_GET[id]'");
$e = mysqli_fetch_array($sqlEdit);
?>
<section class="au-breadcrumb m-t-75">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="au-breadcrumb-content">
<div class="au-breadcrumb-left">
<span class="au-breadcrumb-span">You are here:</span>
<ul class="list-unstyled list-inline au-breadcrumb__list">
<li class="list-inline-item active">
<a href="#">Dashboard</a>
</li>
<li class="list-inline-item seprate">
<span>/</span>
</li>
<li class="list-inline-item">Resign Karyawan</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<br>
<div class="col-lg-11">
<div class="card">
<div class="card-header">
<strong>Karyawan</strong>
<small> Resign</small>

</div>
<div style='margin-left:30px;'>
<div class="card-body card-block row">
<form action="aksi_karyawan.php?act=resign" method="post" class="form-horizontal">
</div>
<table  width="900px">

<tr>
<td>
<div class="form-group">
<label for="id" class=" form-control-label">Id Karyawan</label>
<input type="text" value="<?php echo $e['id']; ?>" name="id" placeholder="Masukkan ID Karyawan" class="form-control"style="width: 400px" readonly>
</div>
</td>
<td> 
<div class="form-group">
<label for="nama" class=" form-control-label">Nama Karyawan</label>
<input type="text" name="nama" readonly value="<?php echo $e['nama']?>" placeholder="Masukkan Nama Karyawan" class="form-control"style="width: 400px">
</div>
</td>
</tr>
<tr>
<td>
<div class="form-group">
<label for="tglKeluar" class=" form-control-label">Tanggal Keluar</label>
<input type="date" name="tglKeluar"  placeholder="Masukkan Tanggal Keluar Anda" class="form-control"style="width: 400px" >
</div>
</td>
</tr>

</table>
<div class="card-body">
<input type="submit" class="btn btn-primary " value="Simpan">
<a class="btn btn-danger" href="karyawan.php">kembali</a>


</div>
</div>
</form>
</div>
<?php
break;
}
?>
<?php include"footer.php";?>