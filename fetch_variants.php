<?php
    include('dist/conf/db.php');
    $pdo = Database::connect();    
    
    if (isset($_REQUEST['tower_id'])) {
        $towerId = $_REQUEST['tower_id'];

        // print_r($towerId);
        // exit();

        $sql = "SELECT * FROM property_varients WHERE property_tower_id = :tower_id and status = 'Active'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':tower_id' => $towerId]);

        // print_r($sql);
        // exit();
        $options = "";
        $listing = "";
        $i = 1;
        if ($stmt->rowCount() > 0) {
            $options .= '<option value="">Select Property Variants</option>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option data-subtext="'.$row["area"].'" value="'.$row['property_varients_id'].'">'.$row['varients'].'</option>';
                echo $options;
                $listing .= '<li><a role="option" class="dropdown-item" id="bs-select-3-'.$i.'" tabindex="0"><span class="text">'.$row['varients'].'<small class="text-muted">'.$row["area"].'</small></span></a></li>';
                ++$i;
            }
        } else {
            $options .= '<option value="">No Variants Found</option>';
            $listing .= '<li><a role="option" class="dropdown-item" id="bs-select-3-'.$i.'" tabindex="0"><span class="text">No Variants Found<small class="text-muted">None</small></span></a></li>';
            ++$i;
        }
    } else {
        $options .= '<option value="">Invalid Tower ID</option>';
        $listing .= '<li><a role="option" class="dropdown-item" id="bs-select-3-'.$i.'" tabindex="0"><span class="text">Invalid Tower ID<small class="text-muted">None</small></span></a></li>';
            ++$i;
    }
    
?>

<!-- <div class="mb-4 d-flex gap-4" style="width: 100%;" id="variantDropdown">
   <div class="form-floating form-floating-outline form-floating-bootstrap-select" style="width: 100%;">
      <div class="dropdown bootstrap-select w-100 dropup">
         <select name="property_variants[]" id="selectpickerSubtext" class="selectpicker w-100" data-style="btn-default" data-show-subtext="true" required="" tabindex="null">
                <?php //echo $options; ?>
         </select>
         <button type="button" tabindex="-1" class="btn dropdown-toggle bs-placeholder btn-default" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" title="Select Property Variants" data-id="selectpickerSubtext">
            <div class="filter-option">
               <div class="filter-option-inner">
                  <div class="filter-option-inner-inner">Select Property Variants</div>
               </div>
            </div>
         </button>
         <div class="dropdown-menu" style="max-height: 361.6px; overflow: hidden; min-height: 130px;">
            <div class="inner show" role="listbox" id="bs-select-3" tabindex="-1" aria-activedescendant="bs-select-3-0" style="max-height: 345.6px; overflow: hidden auto; min-height: 114px;">
               <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                  <li class="selected active"><a role="option" class="dropdown-item selected active" id="bs-select-3-0" tabindex="0" aria-setsize="7" aria-posinset="1" aria-selected="true"><span class="text">Select Property Variants</span></a></li>
                  <?php //echo $listing; ?>   
               </ul>
            </div>
         </div>
      </div>
      <label for="selectpickerSubtext" class="">Property Variants</label>
   </div>
</div> -->