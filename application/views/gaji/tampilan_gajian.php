<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('/assets/foto/murid.png')?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $identitas->nama ?></h3>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                <b>No Anggota</b> <a class="float-right"><?php echo $identitas->id_anggota?></a>
                </li>
                <li class="list-group-item">
                <b>Pos</b> <a class="float-right"><?php echo $identitas->nm_pos?> </a>
                </li>
                <li class="list-group-item">
                <b>Bulan</b> <a class="float-right"><?php echo date('M') ?></a>
                </li>
            </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-9">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link " href="#ambil" data-toggle="tab">Ambil Pakan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#histori" data-toggle="tab">Histori Ambil</a></li>
                <li class="nav-item"><a class="nav-link " href="#bayar" data-toggle="tab">Bayar Pakan</a></li>
            </ul>
        </div>
        <div class="card-body">
            <table class="table table-bordered " id="example1" >
                <thead>
                    <th style="text-align:center;">Tanggal</th>
                    <th style="text-align:center;">Jumlah Susu</th>
                    <th style="text-align:center;">Harga @/L</th>
                    <th style="text-align:center;">Jumlah</th>
                </thead>
                <tbody>
                <?php 

                //setoran susu
                if (empty($data_setoran)) {
                    $periode1[]=0;
                    $periode2[]=0;
                    $periode3[]=0;
                }else {
                    foreach ($data_setoran as $setoran) {
                        if (date('d',strtotime($setoran->tgl)) <=10 ) {
                            $periode1[]=$setoran->jml_setoran;
                        }elseif (  date('d',strtotime($setoran->tgl)) <= 20 ) {
                            $periode2[]=$setoran->jml_setoran;
                            // echo $setoran->tgl."<br>";
                        }else {
                            $periode3[]=$setoran->jml_setoran;
                            // echo $setoran->tgl."<br>";
                        }
                    }
                }
                $tot_setoran=((array_sum($periode3)+array_sum($periode2)+array_sum($periode1)) * $data_hargaAktif->nominal_harga);
                $simsuk=(array_sum($periode1 + $periode2 + $periode3) * 100);
                $keswan=(array_sum($periode1 + $periode2 + $periode3) * 35);
                $dana_desa=(array_sum($periode1 + $periode2 + $periode3) * 3);

                //pakan (konsentrat)
                if (empty($data_pakanPakai)) {
                    $sum_pakan[]=0;
                } else {
                    foreach ($data_pakanPakai as $data) {
                        $sum_pakan[]=$data->hrg_jml_pakan;
                    }
                }
                 
                if (empty($data_pakanBayar)) {
                    $sum_bayar[]=0;
                } else {
                    foreach ($data_pakanBayar as $data) {
                        $sum_bayar[]=$data->nominal_byr;
                    }
                }
                $tagihan_pakan=(array_sum($sum_pakan)-array_sum($sum_bayar));

                //menampilkan utang simpan pinjam 
                if (empty($data_angsuran)) {
                    $sum_sp[]=0;
                    $total[]=0;
                }else {
                    foreach ($data_angsuran as $data) {
                        $time=strtotime($data->tgl);
                        $bln_mulai=date('Y-m',strtotime($data->tgl));
                        $bln_akhir=date('Y-m',strtotime("+$data->angsuran Month",$time));
                        if ( date('Y-m')>$bln_mulai and date('Y-m') <= $bln_akhir) {
                            $sum_sp[]=($data->nominal / $data->angsuran);
                            
                        }else {
                            $sum_sp[]=0;
                        }
                        $total[]=$data->nominal;
                    }
                }
                
                //menampilkan data pembayaran angsuran sp
                if (empty($data_bayar)) {
                    $sum_angsuran[]=0;
                }else {
                    foreach ($data_bayar as $data) {
                        $sum_angsuran[]=$data->nominal;
                }
                }
                $gnrt_tagihan=array_sum($sum_sp);
                $sisaTagihan=(array_sum($total) - array_sum($sum_angsuran));

                if( $gnrt_tagihan==0){
                    $tagihan_angsuran=$sisaTagihan;
                }elseif ($gnrt_tagihan > $sisaTagihan) {
                    $tagihan_angsuran=$sisaTagihan;
                }elseif($gnrt_tagihan < $sisaTagihan) {
                    $tagihan_angsuran=$gnrt_tagihan;
                }else {
                    $tagihan_angsuran=$gnrt_tagihan;
                }

                //menampilkan utang peternak di toko
                if (empty($data_toko)) {
                    $sum_utangToko[]=0;
                    $sum_bayarToko[]=0;
                }else {
                    foreach ($data_toko as $data) {
                        if ($data->jenis == "K") {
                            $sum_utangToko[]=$data->jml_tagihan;
                            $sum_bayarToko[]=0;
                        }else {
                            $sum_bayarToko[]=$data->jml_tagihan;
                        }
                    }
                }
                $tagihan_toko=(array_sum($sum_utangToko)-array_sum($sum_bayarToko));                

                //total potongan
                
                ?>
                <form action="gaji/gaji_action" method="get">
                    <tr>
                        <td style="text-align:center;">01 s/d 10</td>
                        <td style="text-align:center;"><?php echo array_sum($periode1) ?></td>
                        <td style="text-align:center;">Rp <?php echo $data_hargaAktif->nominal_harga ?></td>
                        <td style="text-align:center;">Rp <?php echo ($data_hargaAktif->nominal_harga * array_sum($periode1)) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">11 s/d 20</td>
                        <td style="text-align:center;"><?php echo array_sum($periode2) ?></td>
                        <td style="text-align:center;">Rp <?php echo $data_hargaAktif->nominal_harga ?></td>
                        <td style="text-align:center;">Rp <?php echo ($data_hargaAktif->nominal_harga * array_sum($periode2)) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">21 s/d 31</td>
                        <td style="text-align:center;"><?php echo array_sum($periode3) ?></td>
                        <td style="text-align:center;">Rp <?php echo $data_hargaAktif->nominal_harga ?></td>
                        <td style="text-align:center;">Rp <?php echo ($data_hargaAktif->nominal_harga * array_sum($periode3)) ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;">Jumlah</th>
                        <td style="text-align:center;">Rp <?php echo $tot_setoran?></td>
                    </tr>
                    <tr>
                        <td colspan="4" ></td>
                    </tr>
                    <tr>
                        <th colspan="3" >PENERIMAAN KOTOR</th> 
                        <td style="text-align:center;">Rp <?php echo ($data_hargaAktif->nominal_harga * array_sum($periode3)) ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" >POTONGAN</th> 
                    </tr>
                    <tr>
                        <th style="text-align:center;">Simpanan Wajib</th>
                        <td colspan="3"><input type="hidden" class="form-control" name="simpanan_wajib" id="" value=10000>Rp 10.000</td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Simpanan Sukarela</th>
                        <td colspan="3"><input type="hidden" class="form-control" name="simpanan_sukarela" id="" value=<?php echo $simsuk ?>>Rp <?php echo $simsuk ?> </td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Kesehatan Hewan</th>
                        <td colspan="3"><input type="hidden" name="keswan" id="" value=<?php echo $keswan ?>>Rp <?php echo $keswan ?> </td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Dana Desa</th>
                        <td colspan="3"><input type="hidden" name="dana_desa" id="" value=<?php echo $dana_desa ?>>Rp <?php echo $dana_desa ?></td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Konsentrat</th>
                        <td colspan="3"><input type="hidden" name="konsentrat" id="" value=<?php echo $tagihan_pakan ?>>Rp <?php echo $tagihan_pakan ?></td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Simpan Pinjam</th>
                        <td colspan="3"><input type="hidden" name="sp" value=<?php echo $tagihan_angsuran ?>>Rp <?php echo $tagihan_angsuran ?>  </td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Toko</th>
                        <td colspan="3"><input type="hidden" name="toko" value=<?php echo $tagihan_toko ?>>Rp <?php echo $tagihan_toko ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" >JUMLAH POTONGAN</th>
                        <td  style="text-align:center;" ><?php 
                        $tot_potongan=(1000+$simsuk+$keswan+$dana_desa+$tagihan_pakan+$tagihan_angsuran+$tagihan_toko);
                        echo "Rp ".$tot_potongan  ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <th colspan="3">TOTAL PENDAPATAN BERSIH</th>
                        <th>Rp <?php echo $tot_setoran-$tot_potongan ?></th>
                    </tr>
                </tbody>

                    <button type="submit">simpan</button>
                </form>
            </table>
        </div>
    </div>
</div>


<?php
// print_r($identitas);


//menampilkan data setororan susu peternakl


//menampilkan data peternak ambil pakan

// if (isset($sum_pakan) and isset($sum_bayar) ) {
//      echo " tagihan katul : Rp ".$tagihan_pakan;  
// }else {
//      "tagihan katul : Rp 0,- ";  
// }
// echo "<br>";


// if (isset($sum_utangToko) or isset($sum_bayarToko) ) {
//    echo "tagihan toko : Rp ".$tagihan_toko;  
// }else {
//      echo "tagihan toko : Rp 0,- ";  
// }
// echo "<br>";



//keswan
if (empty($data_keswan)) {
    $sumKre_keswan[]=0;
    $sumDeb_keswan[]=0;
}else {
    foreach ($data_keswan as $data) {
        if ($data->jenis == 'K') {
            $sumKre_keswan[]=$data->nominal;
            $sumDeb_keswan[]=0;
        }else {
            $sumDeb_keswan[]=$data->nominal;
            $sumKre_keswan[]=0;
        }
    }
}
$tagihan_keswan=(array_sum($sumKre_keswan)-array_sum($sumDeb_keswan));
echo "<br>";
echo "total tagihan keswan : ".$tagihan_keswan;
echo "<br>";
echo "pendapatan bersih : : ".($tot_setoran-($tagihan_pakan+$tagihan_toko+$tagihan_angsuran+$tagihan_keswan));
