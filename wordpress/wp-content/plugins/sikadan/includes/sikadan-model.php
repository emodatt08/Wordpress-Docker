<?php

function sikadanAdmin() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
  
  
    $tableprefix = $wpdb->prefix . 'real_';
  // Create table for users 
  $userstable = $tableprefix . 'app_users';
  $sql = "CREATE TABLE ".$userstable." (
   user_id INT(11) NOT NULL AUTO_INCREMENT,
   password VARCHAR(250) NOT NULL,
   name VARCHAR(220) DEFAULT NULL,
   email VARCHAR(220) DEFAULT NULL,
   phone VARCHAR(12),
   role_id VARCHAR(3),
   is_admin ENUM('0','1') DEFAULT '0',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(user_id)
  ) ". $charset_collate .";";
  if ($wpdb->get_var("SHOW TABLES LIKE '$userstable'") != $userstable ) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $res= dbDelta($sql);
  //    var_dump("$sql $userstable ". json_encode($res)); die();
    if(!$res){var_dump('error '. $userstable);}
  }
  
  // Create table for addons 
  $proptypetable = $tableprefix . 'prop_type';
  $sql = "CREATE TABLE " . $proptypetable . " (
   prop_type_id INT(11) NOT NULL AUTO_INCREMENT,
   name VARCHAR(100) NOT NULL,
   description TEXT(1250) NUll,
   PRIMARY KEY(prop_type_id)
  ) ". $charset_collate .";";
  if ($wpdb->get_var("SHOW TABLES LIKE '$proptypetable'") != $proptypetable ) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $res= dbDelta($sql); if(!$res){var_dump('error '.$proptypetable);}
  }
  
    $propertytable = $tableprefix . 'property';
    $sql = "CREATE TABLE " . $propertytable . " (
      prop_id INT(11) NOT NULL AUTO_INCREMENT,
      name VARCHAR(100)  NULL,
      description TEXT(1250)  NULL,
      address VARCHAR(50)  NULL,
      rooms VARCHAR(50)  NULL,
      beds VARCHAR(50)  NULL,
      baths VARCHAR(50)  NULL,
      garages VARCHAR(50)  NULL,
      square_metres VARCHAR(50)  NULL,
      image TEXT(1000) NULL,
      latitude DECIMAL(10, 0)  NULL,
      longitude DECIMAL(10, 0)  NULL,
      user_id INT NULL,
      prop_type_id INT NULL,
      price DECIMAL(9, 2),
      PRIMARY KEY  (prop_id),
      FOREIGN KEY(user_id) REFERENCES ".$userstable."(user_id),
      FOREIGN KEY(prop_type_id) REFERENCES ".$proptypetable."(prop_type_id)
    ) ". $charset_collate .";";
    if ($wpdb->get_var("SHOW TABLES LIKE '$propertytable'") != $propertytable) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $res= dbDelta($sql);
  
      if(!$res){var_dump('error'. $propertytable);}
    }
     
  
     
  
     // Create table for vists 
     $visitstable = $tableprefix . 'visits';
     $sql = "CREATE TABLE " . $visitstable . " (
      visit_id INT(11) NOT NULL AUTO_INCREMENT,
      user_id INT(11) NULL,
      prop_id INT(11) NULL,
        date_of_visit DATE,
        PRIMARY KEY(visit_id),
      FOREIGN KEY(user_id) REFERENCES ".$userstable."(user_id),  
      FOREIGN KEY(prop_id) REFERENCES ".$propertytable."(prop_id)
     ) ". $charset_collate .";";
     if ($wpdb->get_var("SHOW TABLES LIKE '$visitstable'") != $visitstable) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $res= dbDelta($sql);
  
      if(!$res){var_dump('error');}
    }
  
     // Create table for amenities 
     $amenitable = $tableprefix . 'amenities';
     $sql = "CREATE TABLE " . $amenitable . " (
      am_id INT(11) NOT NULL AUTO_INCREMENT,
      name VARCHAR(20) NULL,
      image VARCHAR(30) NULL,
      description VARCHAR(40) NULL,
      PRIMARY KEY(am_id)
     ) ". $charset_collate .";";
     if ($wpdb->get_var("SHOW TABLES LIKE '$amenitable'") != $amenitable) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $res= dbDelta($sql);
         //var_dump("$sql $visitstable ". json_encode($res)); die();
      if(!$res){var_dump('error '. $amenitable);}
    }
  
     // Create table for ameniprop 
     $ameniproptable = $tableprefix . 'ameni_prop';
     $sql = "CREATE TABLE " . $ameniproptable . " (
      am_prop_id INT(11) NOT NULL AUTO_INCREMENT,
      am_id INT(11) NULL,
      prop_id INT(11) NULL,
      PRIMARY KEY(am_prop_id),
      FOREIGN KEY(am_id) REFERENCES ".$amenitable."(am_id),  
      FOREIGN KEY(prop_id) REFERENCES ".$propertytable."(prop_id)
     ) ". $charset_collate .";";
     if ($wpdb->get_var("SHOW TABLES LIKE '$ameniproptable'") != $ameniproptable) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $res= dbDelta($sql); if(!$res){var_dump('error '. $ameniproptable);}
    }
  
  
     
     // Create table for roles 
     $rolestable = $tableprefix . 'roles';
     $sql = "CREATE TABLE " . $rolestable . " (
      role_id INT(11) NOT NULL,
      user_id INT(11) NULL,
      role_name VARCHAR(25) NULL,
      PRIMARY KEY(role_id),
      FOREIGN KEY(user_id) REFERENCES ".$userstable."(user_id)
     ) ". $charset_collate .";";
  
    if ($wpdb->get_var("SHOW TABLES LIKE '$rolestable'") != $rolestable) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $res= dbDelta($sql); if(!$res){var_dump('error '.$rolestable);}
    }
    
  }