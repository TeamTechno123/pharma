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
            <h4>User</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> User</h3>
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
                      <label>Name of User</label>
                      <input type="text" class="form-control form-control-sm" name="user_name" id="user_name" value="<?php if(isset($user_info)){ echo $user_info['user_name']; } ?>"  placeholder="Enter Name of User" required >
                    </div>

                    <div class="form-group col-md-6">
                      <label>Gender: </label>
                      <div class="row">
                        <div class="form-check col-6 col-md-3">
                          <input class="form-check-input ml-1" type="radio" name="user_gender" value="Male" <?php if(isset($user_info) && $user_info['user_gender'] == 'Male'){ echo 'checked'; } elseif(!isset($user_info)){ echo 'checked'; } ?>>
                          <label class="form-check-label ml-4">Male</label>
                        </div>
                        <div class="form-check col-6 col-md-3">
                          <input class="form-check-input" type="radio" name="user_gender" value="Female" <?php if(isset($user_info) && $user_info['user_gender'] == 'Female'){ echo 'checked'; } ?>>
                          <label class="form-check-label">Female</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Select Role</label>
                      <select class="form-control select2" name="role_id" id="role_id" data-placeholder="Select Role" required>
                        <option value="">Select Role</option>
                        <?php if(isset($role_list)){ foreach ($role_list as $list) { ?>
                        <option value="<?php echo $list->role_id; ?>" <?php if(isset($user_info) && $user_info['role_id'] == $list->role_id){ echo 'selected'; } if($list->role_status == 0){ echo 'disabled'; } ?> ><?php echo $list->role_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <!-- <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" name="user_address" id="user_address" rows="3"><?php if(isset($user_info)){ echo $user_info['user_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select Country</label>
                      <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($user_info) && $user_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select State</label>
                      <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                        <option value="">Select State</option>
                        <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                        <option value="<?php echo $list->state_id; ?>" <?php if(isset($user_info) && $user_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select City</label>
                      <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                        <option value="">Select City</option>
                        <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                        <option value="<?php echo $list->city_id; ?>" <?php if(isset($user_info) && $user_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Pin Code.</label>
                      <input type="number" min="1" step="1" class="form-control form-control-sm" name="user_pincode" id="user_pincode" value="<?php if(isset($user_info)){ echo $user_info['user_pincode']; } ?>"  placeholder="Enter Pin Code." required >
                    </div> -->
                    <div class="form-group col-md-6">
                      <label>Mobile No.</label>
                      <input type="number" min="5000000000" max="9999999999" step="1" class="form-control form-control-sm" name="user_mobile" id="user_mobile" value="<?php if(isset($user_info)){ echo $user_info['user_mobile']; } ?>"  placeholder="Enter Mobile No." required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm" name="user_email" id="user_email" value="<?php if(isset($user_info)){ echo $user_info['user_email']; } ?>"  placeholder="Enter Email Id" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Password</label>
                      <input type="password" class="form-control form-control-sm" name="user_password" id="user_password" value="<?php if(isset($user_info)){ echo $user_info['user_password']; } ?>"  placeholder="Enter Password" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control form-control-sm" id="user_password" value="<?php if(isset($user_info)){ echo $user_info['user_password']; } ?>"  placeholder="Confirm Password" required >
                    </div>

                    <div class="form-group col-md-6">
                      <label>User Image</label>
                      <input type="file" class="form-control form-control-sm" name="user_image" id="user_image" >
                    </div>
                    <div class="form-group col-md-6">
                      <?php if(isset($user_info) && $user_info['user_image']){ ?>
                        <label>Uploaded User Image</label><br>
                        <img width="200px" src="<?php echo base_url() ?>assets/images/master/<?php echo $user_info['user_image'];  ?>" alt="Slider Image">
                        <input type="hidden" name="old_user_image" value="<?php echo $user_info['user_image']; ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="user_status" id="user_status" value="0" <?php if(isset($user_info) && $user_info['user_status'] == 0){ echo 'checked'; } ?>>
                          <label for="user_status" class="custom-control-label">Disable This User</label>
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
                <h3 class="card-title">List All User</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>User Name</th>
                    <!-- <th>City</th> -->
                    <th class="wt_100">Mobile No.</th>
                    <th class="">Email</th>
                    <th class="wt_75">Role</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($user_list as $list) { $i++;
                      // $city_details = $this->Master_Model->get_info_arr_fields('city_name','city_id', $list->city_id, 'city');
                      $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'rest_role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>User/edit_user/<?php echo $list->user_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>User/delete_user/<?php echo $list->user_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this User');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->user_name; ?></td>
                        <!-- <td><?php if($city_details){ echo $city_details[0]['city_name']; } ?></td> -->
                        <td><?php echo $list->user_mobile; ?></td>
                        <td><?php echo $list->user_email; ?></td>
                        <td><?php if($role_details){ echo $role_details[0]['role_name']; } ?></td>
                        <td>
                          <?php if($list->user_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                            else{ echo '<span class="text-success">Active</span>'; } ?>
                        </td>
                      </tr>
                    <?php } ?>
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
// Check Mobile Duplication..
  var user_mobile1 = $('#user_mobile').val();
  $('#user_mobile').on('change',function(){
    var user_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"user_mobile",
             "column_val":user_mobile,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#user_mobile').val(user_mobile1);
          toastr.error(user_mobile+' Mobile No Exist.');
        }
      }
    });
  });


</script>
