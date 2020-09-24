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
            <h4>Medicine  Informaiton</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Medicine </h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Master/tax_rate" type="button" class="btn btn-sm btn-outline-info" >Cancel Update</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body p-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      

                     

                      <div class="form-group col-md-6  select_sm">
                        <label>Select Main Group</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select Main Group" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                      <div class="form-group col-md-6  select_sm">
                        <label>Select Sub Group</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select Sub Group" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                       <div class="form-group col-md-6  select_sm">
                        <label>Select Brand Name</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select Brand Name" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                      <div class="form-group col-md-6  select_sm">
                        <label>Select Health Condition</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select Health Condition" required>
                          <option value="">1</option>                       
                          </select>
                      </div>


                       <div class="form-group col-md-12 ">
                        <label>Enter Name Of Item</label>
                        <input type="text" class="form-control form-control-sm" name="test_name" id="test_name" value="<?php if(isset($slider_info)){ echo $slider_info['test_name']; } ?>" placeholder="Enter Name Of Item" required>
                      </div>


                      <div class="form-group col-md-12 ">
                        <label>Printing Name</label>
                        <input type="text" class="form-control form-control-sm" name="test_name" id="test_name" value="<?php if(isset($slider_info)){ echo $slider_info['test_name']; } ?>" placeholder="Printing Name" required>
                      </div>



                      <div class="form-group col-md-6  select_sm">
                        <label>Select Unit</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select Unit" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Tabs Per Strip</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Tabs Per Strip" required>
                      </div>

                       <div class="form-group col-md-6  select_sm">
                        <label>Select GST % </label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select GST %" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                       <div class="form-group col-md-6  select_sm">
                        <label>Select Salt</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Select Salt" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                       <div class="form-group col-md-6">
                        <label>Enter Item Code</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Enter Item Code" required>
                      </div>

                       <div class="form-group col-md-6">
                        <label>Enter HSN Code</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Enter HSN Code" required>
                      </div>

                      <div class="form-group col-md-4">
                        <label>Enter Min Level</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Enter Min Level" required>
                      </div>

                      <div class="form-group col-md-4">
                        <label>Enter Max Level</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Enter Max Level" required>
                      </div>

                       <div class="form-group col-md-4">
                        <label>Enter Reorder Level</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Enter Reorder Level" required>
                      </div>

                      <div class="col-md-3 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="tax_rate_status" id="tax_rate_status" value="0" <?php if(isset($tax_rate_info) && $tax_rate_info['tax_rate_status'] == 0){ echo 'checked'; } ?>>
                            <label for="tax_rate_status" class="custom-control-label">Schedule H</label>
                          </div>
                    </div>

                      <div class="col-md-3 text-left">
                           <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="tax_rate_status" id="tax_rate_status" value="0" <?php if(isset($tax_rate_info) && $tax_rate_info['tax_rate_status'] == 0){ echo 'checked'; } ?>>
                            <label for="tax_rate_status" class="custom-control-label">Schedule H-1</label>
                          </div> 
                        </div>

                        <div class="col-md-3 text-left">
                           <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="tax_rate_status" id="tax_rate_status" value="0" <?php if(isset($tax_rate_info) && $tax_rate_info['tax_rate_status'] == 0){ echo 'checked'; } ?>>
                            <label for="tax_rate_status" class="custom-control-label">Anti TB</label>
                          </div>
                        </div>

                        <div class="col-md-3 text-left">
                           <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="tax_rate_status" id="tax_rate_status" value="0" <?php if(isset($tax_rate_info) && $tax_rate_info['tax_rate_status'] == 0){ echo 'checked'; } ?>>
                            <label for="tax_rate_status" class="custom-control-label">Norcotics Item</label>
                          </div>
                        </div>

                       <div class="form-group col-md-6  select_sm">
                        <label>Prescription Required</label>
                        <select class="form-control select2" name="parent_group_id" id="parent_group_id" data-placeholder="Prescription Required" required>
                          <option value="">1</option>                       
                          </select>
                      </div>

                       <div class="form-group col-md-6">
                        <label>Barcode</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Barcode" required>
                      </div>

                        <div class="form-group col-md-6">
                        <label>MRP</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="MRP" required>
                      </div>

                        <div class="form-group col-md-6">
                        <label>Sale Price</label>
                        <input type="text" class="form-control form-control-sm" name="default_value" id="default_value" value="<?php if(isset($slider_info)){ echo $slider_info['default_value']; } ?>" placeholder="Sale Price" required>
                      </div>

                      
                       <div class="form-group col-md-6">
                      <label>image </label>
                      <input type="file" class="form-control form-control-sm" name="brand_logo" id="brand_logo" >
                    </div>
              
                      
                     
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="tax_rate_status" id="tax_rate_status" value="0" <?php if(isset($tax_rate_info) && $tax_rate_info['tax_rate_status'] == 0){ echo 'checked'; } ?>>
                            <label for="tax_rate_status" class="custom-control-label">Disable This</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php base_url(); ?>test" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header">
                <h3 class="card-title">List All Medicine Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Medicine Name</th>
                    <th>Unit </th>
                    <th>Item Code</th>
                    <th>Cost</th>
                    <th>Group</th>
                    <th>Image</th>                    
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($tax_rate_list)){
                     $i=0; foreach ($tax_rate_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-tax_rate">
                          <a href="<?php echo base_url() ?>Master/edit_tax_rate/<?php echo $list->tax_rate_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Master/delete_tax_rate/<?php echo $list->tax_rate_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Test Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <?php if($list->tax_rate_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
