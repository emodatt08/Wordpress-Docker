<?php
register_activation_hook( __FILE__, 'sikadanAdmin');
if(is_admin()){
    function sikadanAdminPageContent() {
      add_menu_page('Sikadan', 'Sikadan Homes', 'manage_options', 'sikadan', 'sikadanCrudAdminPage', 'dashicons-admin-home');
    }
    add_action('admin_menu', 'sikadanAdminPageContent');
  }


function sikadanCrudAdminPage() {
    global $wpdb;
    $tableprefix = $wpdb->prefix . 'real_';
    $proptypetable = $tableprefix . 'prop_type';
    $propertytable = $tableprefix . 'property';
  if (isset($_POST['save_property'])) {
            $name = $_POST['name'];
            $type = $_POST['prop_type_id'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $address = $_POST['address'];
            $rooms = $_POST['rooms'];
            $beds = $_POST['beds'];
            $baths = $_POST['baths'];
            $garages = $_POST['garages'];
            $metres = $_POST['metres'];
            $lat = '13.983';
            $lon = '1.345';
            $price = (isset($_POST['price'])) ? $_POST['price']:'';

              if ( ! function_exists( 'wp_handle_upload' ) ) {
                  require_once( ABSPATH . 'wp-admin/includes/file.php' );
              }
                //selected file to upload
              $uploadedfile = $_FILES['upload_prop'];

                //wp_handle_upload to upload the file. Check documentation.
              $upload_overrides = array( 'test_form' => false );
              $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

              if ( $movefile && !isset( $movefile['error'] ) ) {
                  //uploaded file url
                  $attachments_url = $movefile['url'];

                  //uploaded file path
                  //$attachments_file = $movefile['file'];
                  //var_dump( $attachments_url,$attachments_file); die;
              }else{
                  echo "error uploading";
              }

//      var_dump("INSERT INTO $propertytable
//      (name,description,address,rooms,beds,baths,garages,metres,image,longitude,latitude)VALUES('$name','$description','$address','$rooms','$beds','$baths','$garages','$metres','$prop_image','$lon','$lat')"); die;
      //$prop_image = $_FILES['upload_prop'];
            //var_dump($name,$email,$address,$rooms,$beds,$baths,$garages,$metres); die();
            $save = $wpdb->query("INSERT INTO $propertytable
            (name,description,address,rooms,beds,baths,garages,square_metres,image,longitude,latitude, prop_type_id, price) 
            VALUES('$name','$description','$address','$rooms','$beds','$baths','$garages','$metres','$attachments_url','$lon','$lat', '$type', '$price')");

            if($save){
              //var_dump(plugin_dir_path( __FILE__ )); die;
              $success = "Property Saved";
              echo "<script>location.replace('admin.php?page=sikadan&message=$success');</script>";
            }else{
              //var_dump(plugin_dir_path( __FILE__ )); die;
              $success = "Property Saving Failed";
              echo "<script>location.replace('admin.php?page=sikadan&message=$success');</script>";
            }

  }
  if (isset($_POST['uptsubmit'])) {
    $id = $_POST['uptid'];
    $name = $_POST['uptname'];
    $email = $_POST['uptemail'];
    $wpdb->query("UPDATE $propertytable SET name='$name',email='$email' WHERE user_id='$id'");
    echo "<script>location.replace('admin.php?page=crud.php');</script>";
  }
  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $propertytable WHERE user_id='$del_id'");
    echo "<script>location.replace('admin.php?page=sikadan.php');</script>";
  }
  ?>
  <div class="wrap">
  <style>
    /* Add a black background color to the top navigation */
    .topnav {
    background-color: #333;
    overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
    background-color: #ddd;
    color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
    background-color: #4CAF50;
    color: white;
}

    /* Style inputs, select elements and textareas */
    input[type=text], select, textarea{
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
    }

    /* Style the label to display next to the inputs */
    label {
        padding: 12px 12px 12px 0;
        display: inline-block;
    }

    /* Style the submit button */
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: left;
    }

    /* Style the container */
    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }

    /* Floating column for labels: 15% width */
    .col-25 {
        float: left;
        width: 15%;
        margin-top: 6px;
    }

    /* Floating column for inputs: 75% width */
    .col-75 {
        float: left;
        width: 55%;
        margin-top: 6px;
    }
    .submit{
        float:left;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
        .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }
  </style>
        <div class="topnav">
            <a class="active" href="#home">Properties</a>
            <a href="#news">Users</a>
            <a href="#news">Visits</a>
            <a href="#news">Amenities</a>
            <a href="#contact">Contact</a>
            <a href="#about">About Sikadan</a>
        </div>
    <h2>Property Operations</h2>
      <?php if(isset($_GET['message'])){ echo $_GET['message']; }?>
      <div class="container">
          <form action="#" method="post" enctype="multipart/form-data">

              <div class="row">

                  <div class="col-75">
                      <label for="fname">Property Name</label>
                      <input type="text" id="fname" name="name" placeholder="Property name..">
                  </div>
              </div>

              <div class="row">
                  <div class="col-75">
                      <label for="fname">Property Description</label>
                      <textarea id="subject" name="description" placeholder="Property Description" style="height:200px"></textarea>
                  </div>
              </div>


              <div class="row">
                  <div class="col-75">
                      <label for="lname">Address</label>
                      <textarea id="subject" name="address" placeholder="Property Address" style="height:200px"></textarea>
                  </div>
              </div>
              <div class="row">
                  <div class="col-25">
                      <label for="fname">Property Image</label>
                  </div>
                  <div class="col-75">

                      <input type="file" id="fname" name="upload_prop" placeholder="">
                  </div>
              </div>
              <div class="row">
                  <div class="col-25">
                      <label for="lname">Price</label>
                  </div>
                  <div class="col-75">
                      <input type="text" style="width:100px;" id="lname" name="price" placeholder="">
                  </div>
              </div>
              <div class="row">
                  <div class="col-25">
                      <label for="lname">Rooms</label>
                  </div>
                  <div class="col-75">
                      <input type="text" style="width:100px;" id="lname" name="rooms" placeholder="">
                  </div>
              </div>

              <div class="row">
                  <div class="col-25">
                      <label for="lname">Beds</label>
                  </div>
                  <div class="col-75">
                      <input type="text" style="width:100px;" id="lname" name="beds" placeholder="">
                  </div>
              </div>

              <div class="row">
                  <div class="col-25">
                      <label for="lname">Baths</label>
                  </div>
                  <div class="col-75">
                      <input type="text" style="width:100px;" id="lname" name="baths" placeholder="">
                  </div>
              </div>

              <div class="row">
                  <div class="col-25">
                      <label for="lname">Garages</label>
                  </div>
                  <div class="col-75">
                      <input type="text" style="width:100px;" id="lname" name="garages" placeholder="">
                  </div>
              </div>

              <div class="row">
                  <div class="col-25">
                      <label for="lname">Metres</label>
                  </div>
                  <div class="col-75">
                      <input type="text" style="width:100px;" id="lname" name="metres" placeholder="">
                  </div>
              </div>

              <div class="row">
                  <div class="col-25">
                      <label for="country">Types</label>
                  </div>
                  <div class="col-75">
                      <select name="prop_type_id">
                          <?php
                          $result = $wpdb->get_results("SELECT * FROM $proptypetable");
                          foreach ($result as $prop) {?>
                              <option value="<?php echo $prop->prop_type_id; ?>"><?php echo $prop->name; ?></option>
                          <?php  } ?>

                      </select>
                  </div>
              </div>
              <div class="row">
                  <input type="submit" class="submit" name="save_property" value="Submit Property">
              </div>
          </form>
      </div>

    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
          <th width="15%">Image</th>
          <th width="15%">Property Name</th>
          <th width="15%">Property Address</th>
          <th width="15%">No Of Rooms</th>
          <th width="15%">No Of Beds</th>
          <th width="15%">Property Type</th>
          <th width="15%">No Of Baths</th>
          <th width="15%">No Of Garages</th>
          <th width="15%">Square Metres</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $propertytype = $propertytable.".prop_type_id";
        $propertytypetable = $proptypetable.".prop_type_id";
        $name = $proptypetable.".name";
          $result = $wpdb->get_results("SELECT $propertytable.*, $name AS propTypeName  FROM $propertytable JOIN $proptypetable ON $propertytype = $propertytypetable ");
          //var_dump("SELECT $propertytable.*, $name AS propTypeName  FROM $propertytable JOIN $proptypetable IN $propertytype = $propertytypetable"); die;
            $uploads = wp_upload_dir();
          foreach ($result as $prINT) {
            echo "
              <tr>
              <td width='15%'><img src='$prINT->image' style = 'width:100px; height:100px;'></td>
                <td width='15%'>$prINT->name</td>
                <td width='15%'>$prINT->address</td>
                <td width='15%'>$prINT->rooms</td>
                <td width='15%'>$prINT->beds</td>
                <td width='15%'>$prINT->propTypeName</td>
                <td width='15%'>$prINT->baths</td>
                <td width='15%'>$prINT->garages</td>
                <td width='15%'>$prINT->square_metres</td>
                <td width='15%'><a href='admin.php?page=crsikadanud.php&upt=$prINT->user_id'><button type='button'>UPDATE</button></a> <a href='admin.php?page=crud.php&del=$prINT->user_id'><button type='button'>DELETE</button></a></td>
              </tr>
            ";
          }
        ?>
      </tbody>  
    </table>
    <br>
    <br>

  </div>
  <?php
}