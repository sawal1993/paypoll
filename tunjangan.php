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
<a href="tunjangan.php?view=tambah" class="btn btn-primary" style="float: right; margin-right: 30px ; margin-top: 40px" >Tambah Data tunjangan Karyawan</a>
<table  class="table " >
</div>
<thead>
<tr>
<th align='center'>No</th>
<th align='center'>Id Karyawan</th>
<th align='center'>Nama Karyawan</th>
<th align='center'>Jumlah Kasbon</th>
<th align='center'>Keterangan</th>
<th align='center'>Tanggal Absen</th>
<th align='center' style="width: 100px;">Aksi</th>                                                                                    
</tr>
</thead>
<?php
$sql = mysqli_query($konek,"select * from tunjangans");
$no=1;
while($d= mysqli_fetch_array($sql)){
echo 
"<tr>
<td width='40px' align='center'>$no</td>
<td align='center'>$d[fungsional]</td>
<td align='center'>$d[keluarga]</td>
<td align='center'>$d[transport]</td>
<td align='center'>$d[idTunjangan]</td>
<td align='center'>$d[makanFas]</td>
<td align='center'>$d[lemburUmum]</td>
<td align='center'>$d[lemburKhusus]</td>
<td align='center'>$d[bpjsKes]</td>
<td align='center'>$d[bpjsKet]</td>
<td align='center'>$d[id_jabatan]</td>
<td width='40px' align='center'>
<a class='btn btn-warning btn-sm fa fa-edit' href='tunjangan.php?view=edit&id=$d[id]' ></a>
<a class='btn btn-danger btn-sm fa fa fa-eraser' href='aksi_tunjangan.php?act=del&id=$d[id]'></a>
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
<li class="list-inline-item">Tambah tunjangan</li>
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
<strong>tunjangan</strong>
<small> Tambah</small>
</div>
<div style='margin-left:30px;'>
<div class="card-body card-block row">
<form method="post" action="aksi_tunjangan.php?act=insert" class="form-horizontal">
</div>
    <table  width="900px">
      <tr>
        <td>
        <div class="form-group">
  <label for="fungsional" class=" form-control-label">Nama Fungsional</label>
      <input type="text" name="fungsional" id="fungsional" class="form-control"style="width: 400px"/>
    </div>  
    </td>
    <td>
         <div class="form-group">
  <label for="keluarga" class=" form-control-label">Keluarga</label>
      <input type="number" name="keluarga" id="keluarga" class="form-control"style="width: 400px"/>
    </div>
    </td>
      </tr>
      <tr>
       <td>
        <div class="form-group">
  <label for="jumlahKasbon" class=" form-control-label">jumlah Kasbon</label>
      <input type="number" name="jumlahKasbon" id="jumlahKasbon" class="form-control"style="width: 400px"/></td>
       <td>
        <div class="form-group">
        <label for="idTunjangan" class=" form-control-label">Id Tunjangan</label>
        <input type="number"name="idTunjangan" id="idTunjangan"  class="form-control" style="width: 400px"/>
        </td>
    </div>
      </tr>
      <tr>
      <tr>
          <td>
                  <label for="idT" class="form-control-label">Keterangan</label>
                  <textarea rows="5" class="form-control" id="keterangan" name="keterangan" style="width: 400px">
                  </textarea>
          </td>
      </tr>
    </table>
<div class="card-body">
<input type="submit" class="btn btn-primary" value="simpan">
<a class="btn btn-danger" href="kasbon.php">kembali</a>
</div>
</div>
</div>
</form>
</div>
<?php
break;
case "edit";
$sqlEdit = mysqli_query($konek,"select * from kasbons a join karyawans b on a.idKaryawan = b.id where a.idKaryawan='$_GET[id]'");
$e = mysqli_fetch_array($sqlEdit);
$query = "SELECT max(id) as id FROM pinjamen";
$hasil = mysqli_query($konek,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['id'];
$noUrut = (int) substr($kodeBarang, 3, 3);
$noUrut++;
$char = "K";
$kodeBarang = $noUrut;
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
<li class="list-inline-item">Edit Absensi Karyawan</li>
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
<form action="aksi_kasbon.php?act=update" method="post" class="form-horizontal">
</div>
  <table  width="900px">
       <tr>
        <td>
            <div class="form-group">
                <label for="idKaryawan" class=" form-control-label">Id Karyawan</label>
           <input type="text" name="idKaryawan" id="idKaryawan" value="<?php echo $e['idKaryawan']?>" readonly class="form-control"style="width: 400px"/>
    </td>
    <td>
         <div class="form-group">
  <label for="id" class=" form-control-label">Nama Karyawan</label>
      <input type="text" name="nama" id="nama" value="<?php echo $e['nama']?>" class="form-control" readonly style="width: 400px"/>
    </td>
      </tr>
      <tr>
       <td>
        <div class="form-group">
  <label for="jumlahKasbon" class=" form-control-label">jumlah Kasbon</label>
      <input type="number" name="jumlahKasbon" id="jumlahKasbon" value="<?php echo $e['jumlahKasbon']?>"  class="form-control"style="width: 400px"/></td>
       <td>
        <div class="form-group">
        <label for="TanggalKasbon" class=" form-control-label">Tanggal Kasbon</label>
        <input type="date"name="TanggalKasbon" id="TanggalKasbon" value="<?php echo $e['tgl']?>" class="form-control" style="width: 400px"/>
        </td>
    </div>
     
      <tr>
          <td>
              <label for="keterangan" class="form-control-label">Keterangan</label>
              <textarea rows="5" class="form-control" id="keterangan" name="keterangan" style="width: 400px"><?php echo $e['keterangan']?>
              </textarea>
          </td>
      </tr>
    </table>
<div class="card-body">
<input type="submit" class="btn btn-primary" value="simpan">
<a class="btn btn-danger" href="kasbon.php">kembali</a>
</div>
</div>
</div>
</form>
</div>
<?php
break;
}
?>
<?php include"footer.php";?>

