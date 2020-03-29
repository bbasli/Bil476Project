<?php

  require_once("create_db.php");
  include "SimpleXLSX.php";
  include 'connect_db.php';

  $company = "";
  $address = "";
  $product_type = "";
  $product_category = "";
  $product = "";
  $cheating_reason = "";
  $active_substance = "";
  $latitude = "0.0";
  $longitude = "0.0";
  $brand = "";
  $serial_number = "";
  $date = "";
  $check = false;
  $files = array("2.2020", "2020", "07012015", "12202019", "17122016", "22072015", "23032018", "28102014", "31122015", "tarihsiz", "19102019", "31082016");

  $res = mysqli_query($conn, "SELECT * FROM products");
  if(!$res){
    echo "Check Table Query Error: " . mysqli_error($conn);
    exit(0);
  }else{
    if(mysqli_num_rows($res) == 0){
      foreach($files as $file)
        if ( $xlsx = SimpleXLSX::parse('XLSX/'.$file.'.xlsx') ) {
          foreach ($xlsx->rows() as $elt){
            if($check){
              for($i=0; $i<count($elt); $i++) {
                if($i == 0){
                  $company = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 1){
                  $address = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 2){
                  $product_type = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 3){
                  $product_category = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 4){
                  $product = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 5){
                  $cheating_reason = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 6){
                  $active_substance = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 7){
                  $latitude = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 8){
                  $longitude = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 9){
                  $brand = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else if($i == 10){
                  $serial_number = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
                }else
                  $date = mysqli_real_escape_string($conn, strtolower(handleChar($elt[$i])));
              }
            
              $insert_sql = "INSERT INTO products(company, address, product_type, product_category, product, cheating_reason, active_substance, latitude, longitude, brand, serial_number, document_date) VALUES ('$company', '$address', '$product_type', '$product_category', '$product', '$cheating_reason', '$active_substance', '$latitude', '$longitude', '$brand', '$serial_number', '$date')";

              if(!mysqli_query($conn, $insert_sql)){
              	echo 'Query error: ' . mysqli_error($conn);
              	exit(0);
              }
            }
            
            $check = true;
            
          }
    }else {
      echo SimpleXLSX::parseError();
    }
    }
      //echo "Num of rows : " . mysqli_num_rows($res);
      header("Location: showCharts.php");

    
  }

  function handleChar($str){

     $str = str_replace("Ü", "u", $str);
     $str = str_replace("ü", "u", $str);
     $str = str_replace("İ", "i", $str);
     $str = str_replace("ı", "i", $str);
     $str = str_replace("ö", "u", $str);
     $str = str_replace("Ö", "o", $str);
     $str = str_replace("ç", "c", $str);
     $str = str_replace("Ç", "c", $str);
     $str = str_replace("Ğ", "g", $str);
     $str = str_replace("ğ", "g", $str);
     $str = str_replace("Ş", "s", $str);
     $str = str_replace("ş", "s", $str);

     return $str;
  }
?>