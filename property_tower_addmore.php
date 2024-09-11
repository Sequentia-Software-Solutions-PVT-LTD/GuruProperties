<?php
if(!class_exists('Database')){
  include ('dist/conf/db.php');
} 
$pdo = Database::connect();

?>

                          <div class="row">
                            
                            <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <select id="roleDropdown" name="property_name_id[]" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                        <option value="" data-select2-id="18">Select Property Name</option>
                                        <?php
                                            $sql = "SELECT * FROM  property_name where status = 'Active'";
                                            foreach ($pdo->query($sql) as $row) 
                                            { 
                                            ?>
                                                <option value="<?php echo $row['property_name_id']?>"><?php echo $row['property_title']?></option> 
                                            <?php } ?>
                                    </select>
                                <label for="form-repeater-1-1">Property Name</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" name="property_tower[]" id="formtabs-username" class="form-control" placeholder="Property Tower"  required>
                                <label for="form-repeater-1-2"> Property Tower</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" name="builder_possession[]" id="formtabs-username" class="form-control" placeholder="Builder Possession" required>
                                <label for="form-repeater-1-3">Builder Possession</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                              <input type="text" name="rera_possession[]" id="formtabs-username" class="form-control" placeholder=" RERA Possession" required>
                                <label for="form-repeater-1-4"> RERA Possession</label>
                              </div>
                            </div>

                          </div>
                          <hr class="mt-0">
                        </div>