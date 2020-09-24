<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Branch</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Branch</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-12">
                      <label>Branch Name</label>
                      <input type="text" class="form-control form-control-sm" name="branch_name" id="branch_name" value="<?php if(isset($branch_info)){ echo $branch_info['branch_name']; } ?>" placeholder="Enter Branch Name" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" rows="3" name="branch_address" id="branch_address" placeholder="Enter Branch Address" required><?php if(isset($branch_info)){ echo $branch_info['branch_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select Country</label>
                      <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($branch_info) && $branch_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select State</label>
                      <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                        <option value="">Select State</option>
                        <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                        <option value="<?php echo $list->state_id; ?>" <?php if(isset($branch_info) && $branch_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select City</label>
                      <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                        <option value="">Select City</option>
                        <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                        <option value="<?php echo $list->city_id; ?>" <?php if(isset($branch_info) && $branch_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <!-- <div class="form-group col-md-4">
                      <label>Statecode</label>
                      <input type="number" class="form-control form-control-sm" name="branch_statecode" id="branch_statecode" value="<?php if(isset($branch_info)){ echo $branch_info['branch_statecode']; } ?>" placeholder="Statecode">
                    </div> -->
                    <!-- <div class="form-group col-md-4">
                      <label>Pin/Zip Code</label>
                      <input type="number" class="form-control form-control-sm" name="branch_pincode" id="branch_pincode" value="<?php if(isset($branch_info)){ echo $branch_info['branch_pincode']; } ?>" placeholder="Pin/Zip Code">
                    </div> -->
                    <div class="form-group col-md-6">
                      <label>Mobile No. 1</label>
                      <input type="number" min="5555555555" max="9999999999" step="1" class="form-control form-control-sm" name="branch_mobile" id="branch_mobile" value="<?php if(isset($branch_info)){ echo $branch_info['branch_mobile']; } ?>" placeholder="Mobile No. 1" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobile No. 2 / Landline No.</label>
                      <input type="number" min="5555555555" max="9999999999" step="1" class="form-control form-control-sm" name="branch_mobile2" id="branch_mobile2" value="<?php if(isset($branch_info)){ echo $branch_info['branch_mobile2']; } ?>" placeholder="Mobile No. 2">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm" name="branch_email" id="branch_email" value="<?php if(isset($branch_info)){ echo $branch_info['branch_email']; } ?>" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="branch_status" id="branch_status" value="0" <?php if(isset($branch_info) && $branch_info['branch_status'] == 0){ echo 'checked'; } ?>>
                          <label for="branch_status" class="custom-control-label">Disable This Branch</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php base_url(); ?>User/user_information" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                        } else{
                          echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                        } ?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Branch</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Branch Name</th>
                    <th>City</th>
                    <th class="wt_100">Mobile No.</th>
                    <th class="">Email</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($branch_list)){ $i=0; foreach ($branch_list as $list) { $i++;
                      $city_details = $this->Master_Model->get_info_arr_fields('city_name','city_id', $list->city_id, 'city');
                      // $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>User/edit_branch/<?php echo $list->branch_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>User/delete_branch/<?php echo $list->branch_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Branch');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->branch_name; ?></td>
                        <td><?php if($city_details){ echo $city_details[0]['city_name']; } ?></td>
                        <td><?php echo $list->branch_mobile; ?></td>
                        <td><?php echo $list->branch_email; ?></td>
                        <td>
                          <?php if($list->branch_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                            else{ echo '<span class="text-success">Active</span>'; } ?>
                        </td>
                      </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
<script type="text/javascript">
// Check Mobile Duplication In Branch..
  var branch_mobile1 = $('#branch_mobile').val();
  $('#branch_mobile').on('change',function(){
    var branch_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"branch_mobile",
             "column_val":branch_mobile,
             "table_name":"rest_branch"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#branch_mobile').val(branch_mobile1);
          toastr.error(branch_mobile+' Mobile No Exist.');
        }
      }
    });

    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"user_mobile",
             "column_val":branch_mobile,
             "table_name":"rest_user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#branch_mobile').val(branch_mobile1);
          toastr.error(branch_mobile+' Mobile No Exist in User.');
        }
      }
    });
  });

  // Check Mobile Duplication In User..
    // var branch_mobile1 = $('#branch_mobile').val();
    // $('#branch_mobile').on('change',function(){
    //   var branch_mobile = $(this).val();
    //   $.ajax({
    //     url:'<?php echo base_url(); ?>Master/check_duplication',
    //     type: 'POST',
    //     data: {"column_name":"branch_mobile",
    //            "column_val":user_mobile,
    //            "table_name":"rest_user"},
    //     context: this,
    //     success: function(result){
    //       if(result > 0){
    //         $('#branch_mobile').val(branch_mobile1);
    //         toastr.error(branch_mobile+' Mobile No Exist in User.');
    //       }
    //     }
    //   });
    // });

  $("#country_id").on("change", function(){
    var country_id =  $('#country_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/get_state_by_country',
      type: 'POST',
      data: {"country_id":country_id},
      context: this,
      success: function(result){
        $('#state_id').html(result);
      }
    });
  });

  $("#state_id").on("change", function(){
    var state_id =  $('#state_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/get_city_by_state',
      type: 'POST',
      data: {"state_id":state_id},
      context: this,
      success: function(result){
        $('#city_id').html(result);
      }
    });
  });


</script>
