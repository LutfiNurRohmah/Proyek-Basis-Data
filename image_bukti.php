<?php
include('konek.php');
if(isset($_GET['IdSaldo'])) 
{
    $query = mysqli_query($mysqli,"SELECT bukti_transaksi FROM pengisian_saldo WHERE id_isisaldo='".$_GET['IdSaldo']."'");
    $row = mysqli_fetch_array($query);
    echo $row["bukti_transaksi"];
}
else
{
    header('location:konfirm_saldo.php');
}
?>