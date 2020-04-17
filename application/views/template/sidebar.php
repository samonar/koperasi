<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('')?>" class="brand-link bg-success">
    <img src="<?php echo base_url()."assets/"; ?>dist/img/ico_kud.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2"
         style="opacity: .8">
    <span class="brand-text font-weight-medium">KUD TL</span>
  </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()."assets/"; ?>foto/admin.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <h5 style="text-transform:capitalize;"><?php echo $this->session->userdata('jabatan'); ?></h5>
        </div>
      </div>
		  <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!--pembagian menu user-->
        <?php if ($session_jabatan=$this->session->userdata('jabatan')=='admin'){?>
          <li class="nav-item has-treeview ">
            <a href="<?php echo site_url('setoran') ?>" class="nav-link <?php if($active=='setoran'){?>active<?php } ?> ">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Setoran
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='sadur'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('Sadur') ?>" class="nav-link <?php if($active_header=='sadur'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Unit Pakan Ternak
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('sadur/bahan_baku') ?>" class="nav-link <?php if($active=='bahan_baku'){?>active<?php } ?> ">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Bahan Baku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('sadur') ?>" class="nav-link <?php if($active=='sadur'){?>active<?php } ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Setok Pakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('sadur/histori') ?>" class="nav-link <?php if($active=='histori'){?>active<?php } ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Histori Unit Pakan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='sp'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('simpan_pinjam') ?>" class="nav-link <?php if($active_header=='sp'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Simpan Pinjam
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='toko'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('toko') ?>" class="nav-link <?php if($active_header=='toko'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Toko
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='gaji'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('gaji') ?>" class="nav-link <?php if($active_header=='gaji'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Gaji
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='pakan'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('pakan') ?>" class="nav-link <?php if($active_header=='pakan'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Konsentrat Peternak
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='anggota'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('anggota') ?>" class="nav-link <?php if($active_header=='anggota'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Anggota
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='simpanan'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('simpanan') ?>" class="nav-link <?php if($active_header=='simpanan'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Simpanan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='harga'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('harga') ?>" class="nav-link <?php if($active_header=='harga'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Pengaturan Harga
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <?php }  
        
        // menu petugas toko
        if ($session_jabatan=$this->session->userdata('jabatan')=='toko'){?>
          <li class="nav-item has-treeview <?php if($active_header=='toko'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('toko') ?>" class="nav-link <?php if($active_header=='toko'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Toko
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
        <?php } ?>

        <!-- menu katul -->
        <?php if ($session_jabatan=$this->session->userdata('jabatan')=='setoran'){?>
          <li class="nav-item has-treeview ">
            <a href="<?php echo site_url('setoran') ?>" class="nav-link <?php if($active=='setoran'){?>active<?php } ?> ">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Setoran
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='harga'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('harga') ?>" class="nav-link <?php if($active_header=='harga'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Pengaturan Harga
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
        <?php } ?>

        <!-- menu pakan -->
        <?php if ($session_jabatan=$this->session->userdata('jabatan')=='katul'){?>
          <li class="nav-item has-treeview <?php if($active_header=='sadur'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('Sadur') ?>" class="nav-link <?php if($active_header=='sadur'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Unit Pakan Ternak
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('sadur/bahan_baku') ?>" class="nav-link <?php if($active=='bahan_baku'){?>active<?php } ?> ">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Bahan Baku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('sadur') ?>" class="nav-link <?php if($active=='sadur'){?>active<?php } ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Setok Pakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('sadur/histori') ?>" class="nav-link <?php if($active=='histori'){?>active<?php } ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Histori Unit Pakan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='pakan'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('pakan') ?>" class="nav-link <?php if($active_header=='pakan'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Konsentrat Peternak
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='harga'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('harga') ?>" class="nav-link <?php if($active_header=='harga'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Pengaturan Harga
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
        <?php } ?>

          <!-- menu kantor -->
        <?php if ($session_jabatan=$this->session->userdata('jabatan')=='kantor'){?>
          <li class="nav-item has-treeview <?php if($active_header=='sp'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('simpan_pinjam') ?>" class="nav-link <?php if($active_header=='sp'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Simpan Pinjam
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='gaji'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('gaji') ?>" class="nav-link <?php if($active_header=='gaji'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Pembayaran Susu
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='anggota'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('anggota') ?>" class="nav-link <?php if($active_header=='anggota'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Anggota
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='grafik'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('setoran/bar') ?>" class="nav-link <?php if($active_header=='grafik'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Grafik Perkembangan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('setoran/bar') ?>" class="nav-link <?php if($active=='bar'){?>active<?php } ?> ">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Setoran Susu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Setoran/ts') ?>" class="nav-link <?php if($active=='ts'){?>active<?php } ?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Grafik TS</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if($active_header=='simpanan'){?>menu-open<?php } ?> ">
            <a href="<?php echo site_url('simpanan') ?>" class="nav-link <?php if($active_header=='simpanan'){?>active<?php } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Simpanan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          </li>
        <?php } ?>
        </ul>
      </nav>
      <!-- Sidebar Menu -->
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
