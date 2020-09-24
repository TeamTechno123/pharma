<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1> Dashboard Information</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Master Summary</h4>
        <!-- <div class="row">
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>50</h3>
                  <p>Main Category</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53</h3>
                  <p>Sub Category</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>3</h3>
                  <p>Blog Inforation</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>Customers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
        </div> -->

        <!-- <div class="row">
          <div class="col-md-12">
            <hr>
            <h5>Hospital Statistic</h5>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital/1">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hospital-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Hospital</span>
                  <span class="info-box-number"><?php echo $hospital_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital/2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hospital-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Govt. Center</span>
                <span class="info-box-number"><?php echo $gov_qua_cnt; ?></span>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital/3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hospital-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Private Center</span>
                <span class="info-box-number"><?php echo $private_qua_cnt; ?></span>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital/4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hospital-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Hotel Quarantine</span>
                  <span class="info-box-number"><?php echo $hotel_qua_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h5>Bed Statistic</h5>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital_bed_list/1">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Regular Bed</span>
                  <span class="info-box-number"><?php echo $regular_bed_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital_bed_list/2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bed"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Oxygen Bed</span>
                <span class="info-box-number"><?php echo $oxygen_bed_cnt; ?></span>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital_bed_list/3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bed"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">ICU Bed</span>
                <span class="info-box-number"><?php echo $icu_bed_cnt; ?></span>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Hospital/hospital_bed_list/4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bed"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Special Bed</span>
                <span class="info-box-number"><?php echo $special_bed_cnt; ?></span>
              </div>
            </div>
          </a>
          </div>
        </div> -->

        <hr>

      </div><!-- /.container-fluid -->
    </section>
  </div>

</body>
</html>
