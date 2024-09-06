<?php
if(!class_exists('Database')){
  include ('dist/conf/db.php');
} 
$pdo = Database::connect();

// $range = ["min" => "3000000", "max" => "15000000"]
// $highest_weight = max(array_column($details, 'Weight'));
// var_dump($highest_weight);
$budget_Values = [
  16000000,
  15000000,
  14000000,
  13000000,
  12000000,
  11000000,
  10000000,
  9000000,
  8000000,
  7000000,
  6000000,
  5000000,
  4000000,
  3000000
];
?>

                          <div class="row">
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" name="input1[]" id="form-repeater-3-5" class="form-control" placeholder="">
                                <label for="form-repeater-1-1">Lead Name</label>
                              </div>
                            </div>
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" name="input2[]" id="form-repeater-3-6" class="form-control" placeholder="">
                                <label for="form-repeater-1-2">Email ID</label>
                              </div>
                            </div>
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <!-- <input type="text" name="input3[]" id="form-repeater-3-7" class="form-control" placeholder=""> -->
                                <select name="input3[]" id="form-repeater-1-3" required class="form-control" placeholder="Select Location">
                                      <option selected disable value="">Select Location</option>
                                      <?php
                                          $sqlLocation = "SELECT * FROM location order by name";
                                          foreach($pdo->query($sqlLocation) as $LocationList) {
                                            echo "<option style='margin-bottom: 8px;' value='".$LocationList["id"]."'>".$LocationList["name"]."</option>";
                                          }
                                      ?>
                                </select>
                                <label for="form-repeater-1-3">Location</label>
                              </div>
                            </div>
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" name="input4[]" id="form-repeater-3-8" class="form-control" placeholder="">
                                <label for="form-repeater-1-4">Contact</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <select name="input5[]" id="form-repeater-3-9" class="form-control" placeholder="">
                                      <option selected disable value="">Select Budget</option>
                                      <?php foreach($budget_Values as $budgetValue) { ?>  
                                          <option><?php echo $budgetValue; ?></option>
                                      <?php } ?>
                                </select>
                                <!-- <input type="text" name="input5[]" id="form-repeater-3-9" class="form-control" placeholder=""> -->
                                <label for="form-repeater-1-5">Budget</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" name="input6[]" id="form-repeater-3-10" class="form-control" placeholder="">
                                <label for="form-repeater-1-6">Source</label>
                              </div>
                            </div>

                            <!-- <div class="mb-6 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                              <button class="btn btn-outline-danger btn-xl waves-effect" data-repeater-delete="">
                                <i class="ri-close-line ri-24px me-1"></i>
                                <span class="align-middle"></span>
                              </button>
                            </div> -->

                          </div>
                          <hr class="mt-0">
                        </div>