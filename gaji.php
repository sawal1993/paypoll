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
<a href="gaji.php?view=tambah" class="btn btn-primary" style="float: right; margin-right: 30px ; margin-top: 40px" >Tambah Data gaji Karyawan</a>
<table  class="table " >
</div>
<thead>
<tr>
<th align='center'>No</th>
<th align='center'>Id Karyawan</th>
<th align='center'>Tanggal Buat</th>
<th align='center'>Potongan</th>
<th align='center'>Gaji Pokok</th>
<th align='center'>Tunjangan</th>
<th align='center'>Total</th>
<th align='center' style="width: 100px;">Aksi</th>                                                                                    
</tr>
</thead>
<?php
$sql = mysqli_query($konek,"select * from head_gajis
");
$no=1;
while($d= mysqli_fetch_array($sql)){
echo 
"<tr>
<td width='40px' align='center'>$no</td>
<td align='center'>$d[idKaryawan]</td>
<td align='center'>$d[tglBuat]</td>
<td align='center'>$d[idPotongan]</td>
<td align='center'>$d[idGapok]</td>
<td align='center'>$d[idTunjangan]</td>
<td align='center'>$d[total]</td>
<td width='40px' align='center'>
<a class='btn btn-warning btn-sm fa fa-edit' href='gaji.php?view=edit&id=$d[id]' ></a>
<a class='btn btn-danger btn-sm fa fa fa-eraser' href='aksi_gaji.php?act=del&id=$d[id]'></a>
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
<li class="list-inline-item">Tambah Gaji</li>
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
<strong>Gaji</strong>
<small> Tambah</small>
</div>
<div style='margin-left:30px;'>
<div class="card-body card-block row">
<form method="post" action="aksi_gaji.php?act=insert" class="form-horizontal">
</div>
<?php
         $konek = mysqli_connect("localhost","root","","payrol");
    $result = mysqli_query($konek,"SELECT (a.fungsional+a.keluarga+a.transport+a.idTunjangan+a.makanFas) as tunjangan,
(b.zakat+b.Pinjaman+b.Kasbon+b.Lainlain+b.makan) as potongan ,d.gapok,c.id,c.nama
 from tunjangans a join potongans b on a.idKaryawan = b.idKaryawan join karyawans c on a.idKaryawan = c.id
join jabatan d on d.namajabatan = c.jabatan
");
$result1 = mysqli_fetch_array($result);
$tunjangan = $result1['tunjangan'];
$potongan = $result1['potongan'];
$gapok = $result1['gapok'];
$total = $gapok+$potongan+$tunjangan;   
?>
    <table  width="900px">
      <tr>
        <td>
  <label for="idKaryawan" class=" form-control-label">Id Karyawan</label>
           <select name="idKaryawan" id="idKaryawan" class=" form-control" onchange="changeValue(this.value)" style="width: 400px" >
        <option value=0>-Pilih-</option>
         <?php
         $konek = mysqli_connect("localhost","root","","payrol");
    $result = mysqli_query($konek,"SELECT (a.fungsional+a.keluarga+a.transport+a.idTunjangan+a.makanFas) as tunjangan,
(b.zakat+b.Pinjaman+b.Kasbon+b.Lainlain+b.makan) as potongan ,d.gapok,c.id,c.nama
 from tunjangans a join potongans b on a.idKaryawan = b.idKaryawan join karyawans c on a.idKaryawan = c.id
join jabatan d on d.namajabatan = c.jabatan
");   
 $jsArray = "var dtMhs = new Array();\n";       
    while ($row = mysqli_fetch_array($result)) {   
        echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';   
        $jsArray .= "dtMhs['".$row['id']."'] = {nama:'".addslashes($row['nama'])."',idPotongan:'".addslashes($row['potongan'])."',idTunjangan:'".addslashes($row['tunjangan'])."',idGapok:'".addslashes($row['gapok'])."',total:'".$total."'};\n";
    }     
    ?>     
        </select>
        </td>
      </tr>
      <tr>
        <td>
        <div class="form-group">
  <label for="fungsional" class=" form-control-label">Nama Karyawan</label>
      <input type="text" name="nama" id="nama" class="form-control"style="width: 400px"/>
    </div>  
    </td>
    <td>
         <div class="form-group">
  <label for="tglBuat" class=" form-control-label">Tanggal Buat</label>
      <input type="date" name="tglBuat" id="tglBuat"  value="<?php echo date('Y-m-d') ?>" class="form-control"style="width: 400px"/>
    </div>
    </td>
      </tr>
      <tr>
       <td>
        <div class="form-group">
  <label for="idPotongan" class=" form-control-label">Potongan</label>
      <input type="number" name="idPotongan" id="idPotongan" class="form-control"style="width: 400px"/></td>
       <td>
        <div class="form-group">
        <label for="idGapok" class=" form-control-label">Gaji Pokok</label>
        <input type="number"name="idGapok" id="idGapok"  class="form-control" style="width: 400px"/>
        </td>
    </div>
      </tr>
       <tr>
       <td>
        <div class="form-group">
  <label for="idTunjangan" class=" form-control-label">Tunjangan</label>
      <input type="number" name="idTunjangan" id="idTunjangan" class="form-control"style="width: 400px"/></td>
       <td>
        <div class="form-group">
        <label for="total" class=" form-control-label">total </label>
        <input type="number"name="total" id="total"  class="form-control" style="width: 400px"/>
        </td>
    </div>
      </tr>
      
       
    </table>
<div class="card-body">
<input type="submit" class="btn btn-primary" value="simpan">
<a class="btn btn-danger" href="tunjangan.php">kembali</a>
</div>
</div>
</div>

</form>
 <script type="text/javascript">   
    <?php echo $jsArray; ?> 
    function changeValue(id){ 


    document.getElementById('nama').value = dtMhs[id].nama;
    document.getElementById('idGapok').value = dtMhs[id].idGapok;
    document.getElementById('idTunjangan').value = dtMhs[id].idTunjangan;
    document.getElementById('idPotongan').value = dtMhs[id].idPotongan;
    document.getElementById('total').value = dtMhs[id].total;
    }; 
    </script>
</div>
<?php
break;
case "edit";
break;
}
?>
<?php include"footer.php";?>

