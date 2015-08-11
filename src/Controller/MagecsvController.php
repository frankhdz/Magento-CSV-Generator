<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Request;
use Cake\I18n\Time;

/**
 * Magecsv Controller
 *
 * @property \App\Model\Table\MagecsvTable $Magecsv
 */
class MagecsvController extends AppController
{
    public function uniquecoloroptions(){
      $file = $this->request->data('csv_file');
      $fileLocation = $file['tmp_name']; 
      $file = fopen($fileLocation,"r");
      $colorColumn =  $this->request->data('ColorColumn');

      $j = 0;
      $colors = array();
      while(!feof($file)){
        $csvitem[$j] = fgetcsv($file);
        $color =  $csvitem[$j][$colorColumn];
        if($j!=0){
           
            
            $col = str_replace(',', '[comma]', trim($color));
            array_push($colors,$col);
        }
        $j++;
      }

      $color_list = array_unique($colors);
      $cnt = count($color_list);
        
        $i = 0;

        asort($color_list);

        $concat = array();
        foreach($color_list as $item){
           $concat[] = $item;
            $i++;
        }
 



      $this->set('count',$cnt);
      #while
      $con_inplode = implode(",", str_replace(",", "&#40;", $concat));
      $this->set('colors',trim($con_inplode,","));

    }
    public function escapecomma($str){
        $val = str_replace(",","\,",$str);
        return $val;
    }
    public function uniqueoption(){
         $file = $this->request->data('csv_file');
         $attributeCol = $this->request->data('AttributeColumn');
         $attributeName = $this->request->data('AttributeName');
         
         //$valueColumns = $this->request->data('ValueColumn');

        $fileLocation = $file['tmp_name'];
        $file = fopen($fileLocation,"r");
        $option_list = array();
        $attribute_column = $attributeCol;
        $attribute_name = $attributeName;
        $value_column = 9;
        $j = 0;
        while(!feof($file)){

            $csvitem[$j] = fgetcsv($file);
           
            if($option = $csvitem[$j][$attribute_column] == $attribute_name){
                
                $option = $csvitem[$j][$value_column];
                if($option != ""){
                    array_push($option_list,$this->converttohtml($option));
                }
            }
            $j++;
        }
        //get key number for headers
        $keyArray[] = array("sku","_store","_attribute_set","_type","_category","_root_category","_product_websites","cost","country_of_manufacture","created_at","custom_design","custom_design_from","custom_design_to","custom_layout_update","description","enable_googlecheckout","enable_zoom_plugin","gallery","gift_message_available","has_options","image","image_label","manufacturer","media_gallery","meta_description","meta_keyword","meta_title","minimal_price","msrp","msrp_display_actual_price_type","msrp_enabled","name","news_from_date","news_to_date","options_container","package_id","page_layout","price","required_options","shipping_qty","short_description","sizes","small_image","small_image_label","soundscan","soundscan_street_date","special_from_date","special_price","special_to_date","status","tax_class_id","thumbnail","thumbnail_label","upc","updated_at","url_key","url_path","visibility","weight","qty","min_qty","use_config_min_qty","is_qty_decimal","backorders","use_config_backorders","min_sale_qty","use_config_min_sale_qty","max_sale_qty","use_config_max_sale_qty","is_in_stock","notify_stock_qty","use_config_notify_stock_qty","manage_stock","use_config_manage_stock","stock_status_changed_auto","use_config_qty_increments","qty_increments","use_config_enable_qty_inc","enable_qty_increments","is_decimal_divided","_links_related_sku","_links_related_position","_links_crosssell_sku","_links_crosssell_position","_links_upsell_sku","_links_upsell_position","_associated_sku","_associated_default_qty","_associated_position","_tier_price_website","_tier_price_customer_group","_tier_price_qty","_tier_price_price","_group_price_website","_group_price_customer_group","_group_price_price","_media_attribute_id","_media_image","_media_lable","_media_position","_media_is_disabled","_super_products_sku","_super_attribute_code","_super_attribute_option","_super_attribute_price_corr","size","show","manufacturer_part_number","brand","target_super_attribute(?)");
        $keys = "";
        foreach($keyArray as $key=>$val){
            foreach($val as $k=>$v){
               $keys .= $k." => ".$v."<br>"."\n";
            }
        }
        $this->set('keys',$keys);
        asort($option_list);
        $option_list_u = array_unique($option_list);
        $this->set("count", count($option_list_u));
        $i = 1;
        asort($option_list_u);
        $concat = "";
        foreach($option_list_u as $item){

            $concat .= $this->converttohtml($item).",";
            $i++;
        }
        $this->set("array_val", $concat);
        fclose($file);


    }

    public function posts(){

        $file = $this->request->data('csv_file');
        $attributeSet = $this->request->data('AttributeSet');
        $this->log($file);
        $this->log("Attribute Set : ".$attributeSet);

        $file = fopen( $file['tmp_name'],"r");
        
        while(!feof($file)){
            $this->log(fgetcsv($file));
        }


    }
    public function converttohtml($string){
        $replacements = '&#44;';
        $entities =",";

        $val = str_replace($entities, $replacements, $string);
   
        return $val;

    }
    public function mediaGallery($images,$labels=""){

        $this->log('MEDIA GALLERY : ');
        $this->log($images);
        $row = array();
        
        if(!empty($images)){
            $_images = explode(',', $images);
            $imgStr = "";

            $i=0;
            $_media_image_col=98;
            $max =110;
            
            $im_pos = 1;
           
            foreach ($_images as $_image=>$val) {
                $im_pos++;
                $row[] = explode(',', ",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$val,,$im_pos,0,,,,,,,,");
            }
        }
        $this->log('IMAGE ARRAY ');
        $this->log($row);
        return $row;
       

    }
    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
          
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
             
                return true;
                break;
            }else{
               
                return false;
                break;
            }
        }
    }
    public function walk( $data, $count=-1, $inc="" ){
        $html = "\n";
        // loop through all items in this level
        $count++;
        foreach( $data as $key => $value ){
            $inc = str_repeat("     ", $count);
            $html .= $inc;
            $html .= '['.$key."] => ".$value."\n";
            $html .= walk( $value,$count,$inc);
        }
        return $html;
    }

    public function main(){
                $useCol = $this->request->data('usecolor');
                $useSuperAttribute = $this->request->data('usesuperattribute');
                $this->log("------------ S -----------------");
                echo "STOP;";
                $tmpfile = $this->request->data('csv_file');
                $attributeSet = $this->request->data('AttributeSet');
                $superAttribute = $this->request->data('SuperAttribute');
                $targetAttributeCol = $this->request->data('TargetSuperAttributeValueColumn');
                $useadditionalcol = $this->request->data('useadditionalcols');
                $superAttributeName = $this->request->data('SuperAttributeName');
                $additionalcols = $this->request->data('AdditionalColumns');
                $disableoutput = $this->request->data('disableoutput');
                $this->log($this->request->data());
                $this->log($tmpfile);
                $this->log("Attribute Set : ".$attributeSet);

                $useAppend = $this->request->data('appendattribute');
                if($useAppend){
                    
                    $appendCol = $this->request->data('appendattributecol');
                    echo "COL >".$appendCol."<br />";
                }
                $fileLocation = $tmpfile['tmp_name'];

                $keyArray = array();
                $startingidcount = 4;
                $startingsku = 10000;
                $maxCount = 10000000000000000000;

                $confimg  = array();


        //************************************************
        //                                              //
        //                                              //
        //                                              //
        //                                              //
        // CSV mapping                                  //
        //                                              //
        //                                              //
        //                                              //
        //************************************************

                $m_attributeset = $attributeSet;
                $m_targetattribute = 8;

                $m_id =             0;
                $m_sku =            14;
                $m_image =          1;
                $m_price =          2;
                $m_stock =          3;
                $m_weight =         4;
                $m_name =           5;
                $m_description =    6;
                $m_category =       7;
                $m_attributevalue = 9;
                $m_attribute =      8;
               
                $m_meta_title = 5;
                $m_root_category = 14;
                $m_color = 10;
                $m_gallery = 11;

                //$alu = 12;
                
                $brand= 12;
                
                $manufacturer_part_number= 13;
                $upc = 14; 
                $m_meta_description = 6;
                
                $m_targetattributecolumn = $targetAttributeCol;
                
               
                $now = new Time();
                $new_from = $now->format('Y-m-d H:i:s');

                $to = new Time('+90 days');
                $tomonths = $to;
                $new_to = $tomonths->format('Y-m-d H:i:s');

               
        $idarray = fopen($fileLocation,"r");
        $all_ids = array();
        $d = 0;
        while(!feof($idarray)){
            $temp_id[$d] = fgetcsv($idarray);
            array_push($all_ids, $temp_id[$d][$m_id]);
        }
        ksort($all_ids);
        $arr_unique = array_unique($all_ids);
        $arr_duplicates = array_unique(array_diff_assoc($all_ids, $arr_unique));
       

        foreach($arr_duplicates as $dup){
            $this->log($dup);
        }
        
        $file = fopen($fileLocation,"r");
        while(!feof($file)){
            $prod[] = fgetcsv($file);
        }
        
        $category_list = array();


        $i = 0;
        foreach($all_ids as $id){
            $productcategories = array();
            if($i>0){
                foreach($prod as $product){
                    if($product[0]===$id){
                        
                        $productcategories[] =  $product[$m_category];
                        
                    }
                }   
                $uni_cat = array_unique($productcategories,SORT_STRING);
                $category_list[$id] = array("id"=>$id,"categories"=>$uni_cat);
            }
            $i++;

        }



        array_unique($category_list,SORT_REGULAR);
        
        $i = $startingidcount;
        $j = 0;
        $iniCount = 0;
        $k = 0;
        $x = 0;
        $optionnum = 0;
        $addfirst = 0;
        $colcnt = 0;

        $keyArray[$colcnt] = array("sku","_store","_attribute_set","_type","_category","_root_category","_product_websites","cost","country_of_manufacture","created_at","custom_design","custom_design_from","custom_design_to","custom_layout_update","description","enable_googlecheckout","enable_zoom_plugin","gallery","gift_message_available","has_options","image","image_label","manufacturer","media_gallery","meta_description","meta_keyword","meta_title","minimal_price","msrp","msrp_display_actual_price_type","msrp_enabled","name","news_from_date","news_to_date","options_container","package_id","page_layout","price","required_options","shipping_qty","short_description","sizes","small_image","small_image_label","soundscan","soundscan_street_date","special_from_date","special_price","special_to_date","status","tax_class_id","thumbnail","thumbnail_label","upc","updated_at","url_key","url_path","visibility","weight","qty","min_qty","use_config_min_qty","is_qty_decimal","backorders","use_config_backorders","min_sale_qty","use_config_min_sale_qty","max_sale_qty","use_config_max_sale_qty","is_in_stock","notify_stock_qty","use_config_notify_stock_qty","manage_stock","use_config_manage_stock","stock_status_changed_auto","use_config_qty_increments","qty_increments","use_config_enable_qty_inc","enable_qty_increments","is_decimal_divided","_links_related_sku","_links_related_position","_links_crosssell_sku","_links_crosssell_position","_links_upsell_sku","_links_upsell_position","_associated_sku","_associated_default_qty","_associated_position","_tier_price_website","_tier_price_customer_group","_tier_price_qty","_tier_price_price","_group_price_website","_group_price_customer_group","_group_price_price","_media_attribute_id","_media_image","_media_lable","_media_position","_media_is_disabled","_super_products_sku","_super_attribute_code","_super_attribute_option","_super_attribute_price_corr","size","show","manufacturer_part_number","brand",$superAttributeName);
       
        if($useadditionalcol){
          
           
            $add_cols = explode(',', $additionalcols);
            $file_col_count = count($prod[0]);

            $count_add_cols = count($add_cols);
            $this->log($file_col_count);
            $count_key_arrays = count($keyArray[0]);

            $cols_commas_str = '';
            $cols_commas_array = array();
            $ci = 1;
            while($ci<=$count_add_cols){
                $cols_commas_str.=',';
                $this->log("ci =".$ci);
                $ci++;
                
            }
            $this->log('EXPLODE COMMAS');
            $this->log($cols_commas_str);
            
            $cols_commas_array = explode(',', $cols_commas_str);
            $this->log('++');
            

            $col_sum = $count_add_cols+$count_key_arrays;
            $tmp_key_array = array_merge($keyArray[0],$add_cols);
            $this->log($tmp_key_array);
            $keyArray[$colcnt] = $tmp_key_array;
            $col_num_val = array();
             
            foreach($add_cols as $columname){
               $tmp_counter = 0;
                foreach($prod[0] as $col){
                    
                    $this->log($tmp_counter);
                    if($columname == $col){
                        $dyn_cols[] = array($columname,$tmp_counter);
                        $col_num_val[] = $tmp_counter;
                    }
                    $tmp_counter++;
                }
               
            }
            $this->log('COUNT THE VALS');
            $this->log($col_num_val);
            $this->log('/COUNT THE VALS');

        }


        $xx = 0;

        
        foreach($prod  as $csvitem){

            if($j>$iniCount){
               
                $isinarray = 0;

                $currentDescription = $csvitem[$m_description];
                
                $prevDescription    = $prod[$j-1][$m_description];

                $prev_color = trim($prod[$j-1][$m_color]," ");

                $currentstring      = $csvitem[2]." ".$currentDescription;
                $prevstring         = $prod[$j-1][2]." ".$prevDescription;
                 $this->log('INI GALLERY : '.$csvitem[$m_gallery]);
                $imagegallery       = $this->mediaGallery($csvitem[$m_gallery]);
                
                if($useAppend){
                    $name = $csvitem[$m_name]." ".$csvitem[$appendCol];
                }else{
                    $name =  $csvitem[$m_name];
                    
                }

                    $confName = $csvitem[$m_name];
                    $ccname =  preg_replace('/_.*/s', '', $name);
                    $ccname = rtrim($ccname, "-");
                    $catname = ucwords($csvitem[$m_category]);  
                    
                    $id = $csvitem[$m_id];
                    $sku = $csvitem[$m_sku];
                    $meta_title = $this->converttohtml($csvitem[$m_meta_title]);
                    $meta_description = $this->converttohtml($csvitem[$m_meta_description]);
                    $galleryimages = $csvitem[$m_gallery];
                    $image = $csvitem[$m_image];
                    $root_category = "Default Category";
                    $super_attribute_code = strtolower($csvitem[$m_attribute]);
                    $super_attribute_value = $csvitem[$m_attributevalue];

                    if($super_attribute_code=="null" || $super_attribute_code=="NULL"){
                        $super_attribute_code="";
                    }
                    if($super_attribute_value=="null" || $super_attribute_value=="NULL"){
                        $super_attribute_value="";
                    }

                    $size = "";
                    $show = "";
                    $color ="";
                    $hascolor = 0;
                    if($csvitem[$m_color]!=""){
                        $hascolor = 1;
                        $simple_color = trim($csvitem[$m_color]," "); 
                        $this->log("SIMPLE COLOR VAL TRIM : ".$simple_color);


                    }else{
                        $hascolor = 0;
                    }

                    $c_color = trim($csvitem[$m_color]," ");
                    if($super_attribute_code=="size"){
                        $size = $super_attribute_value;
                    }
                    if($super_attribute_code=="color"){
                        
                        $color = trim($super_attribute_value," ");
                    }
                    if($super_attribute_code=="show"){
                        $show = str_replace(",", "", trim($super_attribute_value), " ");
                    }


                    if($c_color==$color){
                        $printcolor = trim($color," ");
                    }else{
                        $printcolor = trim($c_color," ");
                    }


                    if($csvitem[$m_attributevalue]!=""){

                        $sku = $csvitem[$m_sku];
                         if($useAppend){
                            $name = $csvitem[$m_name]." ".$csvitem[$appendCol];
                            $meta_title = $csvitem[$m_meta_title]." ".$csvitem[$appendCol];
                         }else{
                            $name =  $csvitem[$m_name]." ".$printcolor;
                            $meta_title = $csvitem[$m_meta_title];
                        }
                        
                    }
                    if($csvitem[$m_attributevalue]=="NULL"){

                         if($useAppend){
                            $name = $csvitem[$m_name]." ".$csvitem[$appendCol];
                            $meta_title = $csvitem[$m_meta_title]." ".$csvitem[$appendCol];
                         }else{
                            $name =  $csvitem[$m_name].$printcolor;
                            $meta_title = $csvitem[$m_meta_title];
                        }
                    }
                    

                    
                    
                    

                    $description = $this->converttohtml($csvitem[$m_description]);

                    if($csvitem[$m_stock]==""){
                        $stockval = 0;
                    }else{
                        $stockval = $csvitem[$m_stock];
                    }

                    $price = $csvitem[$m_price];
                    $qty = $stockval;
                    $product_image = strtolower($csvitem[$m_image]);
                    $weight = $csvitem[$m_weight];

                    


                    

                    similar_text($currentstring, $prevstring, $percent);
                    


                   
                    if($id!=""){
                        if(in_array($id,$arr_duplicates)){

                            $visibility = 1; 
                        }else{
                            $visibility = 4;
                        }
                        
                        $isinarray = $this->in_array_r($sku,$keyArray);


                        if(!$isinarray){
                            $colcnt++;
                            $keyArray[$colcnt]=array("$sku",
                                "default",
                                $m_attributeset,
                                "simple",
                                "",
                                $root_category,
                                "base",
                                //$c_color ,//color
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                $description,
                                1,
                                "Yes",
                                "",//image gallery
                                "",
                                1,
                                "$product_image",
                                "",
                                "",
                                "",//media gallery
                                $meta_description,
                                "",
                                $meta_title,
                                "",
                                "",
                                "Use config",
                                "Use config",
                                ucwords(strtolower("$name")),
                                $new_from,//new from
                                $new_to,//new to
                                "Product Info Column",
                                "",
                                "1 column",
                                "$price",
                                1,
                                "",
                                $description,
                                "",
                                "$product_image",
                                "",
                                "No",
                                "",
                                "",
                                "",
                                "",
                                1,
                                2,
                                "$product_image",
                                "",
                                "",
                                "",
                                "",
                                "",
                                $visibility,
                                "$weight",
                                $qty,
                                0,
                                1,
                                0,
                                0,
                                1,
                                1,
                                1,
                                0,
                                1,
                                1,
                                0,
                                1,
                                1,
                                0,
                                0,
                                1,
                                0,
                                1,
                                0,
                                0,
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "88",
                                "$product_image",
                                "",
                                "1",
                                "0",
                                "",
                                "",
                                "",
                                
                                "",//add different price here?
                                "$show",
                                '',
                                $csvitem[$manufacturer_part_number],
                                $csvitem[$brand],
                                trim($csvitem[$m_targetattributecolumn]," ")
                                );
                    
                        if($useadditionalcol){
                            $this->log("Add These Columns");
                            foreach($col_num_val as $add_col=>$col_val){
                                $this->log($col_val);
                                array_push($keyArray[$colcnt],trim($csvitem[$col_val], " "));

                            }
                           
                        }
                           


        if($visibility==4){
            foreach($category_list as $category){
                                 
                if($category['id']==$id){
                                        
                    foreach($category['categories'] as $catname){
                                       
                        $colcnt++;

                        $keyArray[$colcnt]=array("","","","",ucwords(
                            preg_replace_callback(
                                    '/\/([a-z])/',
                                    function($m){
                                        $str = strtoupper($m[1]);
                                        $concat_str = "/".$str;
                                        return $concat_str;
                                    },
                                    $catname
                            )

                            ),$root_category,"","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
                        
                        if($useadditionalcol){
                            $keyArray[$colcnt] = array_merge($keyArray[$colcnt],$cols_commas_array);
                        }
                    }
                }
            }

            if(!empty($imagegallery)){
                foreach($imagegallery as $row=>$arr){
                    $colcnt++;
                   
                    $this->log($arr);
                    $keyArray[$colcnt++] = $arr;
                }
            }
            
        }

        }

        }



        $isinarray=$this->in_array_r($sku,$keyArray);
        if(!$isinarray){
                       
            if(isset($prod[$j+1][$m_id])){
                if($id == $prod[$j+1][$m_id]){
                    $nextmatch = true;
                    
                }else{
                    $nextmatch = false;
                }
            }else{
                $nextmatch = false;
            }



            if($id == $prod[$j-1][$m_id]){
                $prevmatch = true;
                
            }else{
                $prevmatch = false;
                
            }
            
            $this->log($prevmatch." : ".$nextmatch);
                          
                            if($prevmatch ){
                                
                            
                                $conf_temp_array[$k] = array("$id",
                                    "default",
                                    $m_attributeset,
                                    "configurable",
                                    "",
                                    $root_category,
                                    "base",
                                   // "",color
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    '"'.$description.'"',
                                    1,
                                    "Yes",
                                    "",
                                    "",
                                    1,
                                    "$product_image",
                                    "",
                                    "",//media gallery
                                    $meta_description,//meta description
                                    "",
                                    '"'.$meta_title.'"',//meta title
                                    "",
                                    "",
                                    "",
                                    "Use config",
                                    "Use config",
                                    ucwords(strtolower("$confName")),
                                    $new_from,//new from
                                    $new_to,//new to
                                    "Product Info Column",
                                    "",//options container
                                    "1 column",
                                    "$price",
                                    1,
                                    "",
                                    $description,
                                    "",
                                    "$product_image",
                                    "",
                                    "No",
                                    "",
                                    "",
                                    "",
                                    "",
                                    1,
                                    2,
                                    "$product_image",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    4,
                                    "",
                                    0,//qty
                                    0,
                                    1,
                                    0,
                                    0,
                                    1,
                                    1,
                                    1,
                                    0,
                                    1,
                                    1,
                                    1,
                                    0,
                                    0,
                                    1,
                                    0,
                                    1,
                                    0,
                                    1,
                                    0,
                                    0,
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",//image 88
                                    "",//product image file $product_image
                                    "",
                                    "",//product image position 1
                                    "",// set to 0 image related
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    "",
                                    );
                    
                    if($this->request->data('useswatch')==1){
                        $currentsimplecolor = trim($prod[$j][$m_color]," ");
                       
                            $swatch_Array[] = explode(",",",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$product_image,$currentsimplecolor,0,0,,,,,,,,");
                            
                      

                    }else{
                        if($product_image!="" || $product_image!=null){
                            
                                $swatch_Array[] = explode(",",",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$product_image,,1,0,,,,,,,,");
                                $addimage =1;
                           
                        }
                    }

                        if($useadditionalcol){
                            $conf_temp_array[$k] = array_merge($conf_temp_array[$k],$cols_commas_array);
                        }

        $c_arr = array();
        foreach($category_list as $category){
            
            if($category['id']==$id){

                if($xx==0){
                    foreach($category['categories'] as $catname){
                        if($catname!="NULL"){
                            array_push($c_arr, ucwords(
                            preg_replace_callback(
                                    '/\/([a-z])/',
                                    function($m){
                                        $str = strtoupper($m[1]);
                                        $concat_str = "/".$str;
                                        return $concat_str;
                                    },
                                    $catname
                            )

                            )
                            );
                        }
                        $xx++;
                    }
                }
            }
            
            
        }

        $c_unique = array_unique($c_arr,SORT_STRING);
        $t=0;
        foreach($c_unique as $cname){
             $cat_Array[$t]=array("","","","",$cname,$root_category,"","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
            if($useadditionalcol){
                $cat_Array[$t] = array_merge($cat_Array[$t],$cols_commas_array);
             }


            $t++;
        }
        
        if($x<1){
            $prev_sku = $prod[$j-1][$m_sku];
                                        //echo $prev_sku."<BR>";
            $prev_super_attribute_code = strtolower($prod[$j-1][$m_attribute]);
            
            $prev_super_attribute_value = $prod[$j-1][$m_attributevalue];
            $prev_super_attribute_value = str_replace(",", "", $prev_super_attribute_value);

            if($useadditionalcol){
               $this->log('Adding DYnamic Column Children ');
               $this->log($cols_commas_array[0]);

                
                foreach($dyn_cols as $dynami_col){
                $this->log('COL VAL ADD');
                    $this->log($dynami_col[0]);
                    $this->log($prod[$j-1][$dynami_col[1]]);
                    $_a_col = array_merge(array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$prev_sku",$dynami_col[0],$prod[$j-1][$dynami_col[1]],"","","",""),$cols_commas_array);
                    
                    $children_Array[] = $_a_col;
                    
                }
                
                $children_Array[]=array_merge(array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$prev_sku","$prev_super_attribute_code","$prev_super_attribute_value","","","",""),$cols_commas_array);
                

             }else{
                $children_Array[]=array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$prev_sku","$prev_super_attribute_code",trim("$prev_super_attribute_value"," "),"","","","");
             
             }
            
            if($this->request->data('useswatch')==1){
                $previmage = $prod[$j-1][$m_image];
                $prevsimplecolor = trim($prod[$j-1][$m_color]," ");
                //add simple image value as swatch
                if($useadditionalcol){
                  $swatch_Array[] = array_merge(explode(",",",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$previmage,$prevsimplecolor,0,0,,,,,,,,"),$cols_commas_array);;
                }else{
                    $swatch_Array[] = explode(",",",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$previmage,$prevsimplecolor,0,0,,,,,,,,");
                
                }
            }
        
        }

        $super_attribute_value = str_replace(",", "", $super_attribute_value);
        
        if($useadditionalcol){
            foreach($dyn_cols as $dynami_col){
                   

                    $this->log('COL VAL ADD');
                    $this->log($dynami_col[0]);
                    $this->log($prod[$j][$dynami_col[1]]);
                    $_a_col = array_merge(array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$prev_sku",trim($dynami_col[0]),trim($prod[$j-1][$dynami_col[1]]," "),"","","",""),$cols_commas_array);
                    
                    $children_Array[] = $_a_col;
                   
                }
        }

        if($super_attribute_code!="" || $super_attribute_value!=""){
            $children_Array[]=array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$sku","$super_attribute_code",trim("$super_attribute_value"," "),"","","","");
        } 
        if($hascolor){
            
            if($useadditionalcol){
                $children_Array[] = array_merge(array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$sku","color",trim($simple_color," "),"","","",""),$cols_commas_array);;
            }else{
                 $children_Array[]=array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","$sku","color",trim($simple_color," "),"","","","");
            }
          
           
        }
        if($this->request->data('useswatch')==1){
                $imagepos = $x+1;
                $simple_color = trim($prod[$j][$m_color]," ");
                if($useadditionalcol){
                  $tmp_sw = explode(",",",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$product_image,$simple_color,0,0,,,,,,,,");
                  $swatch_Array[] = array_merge($tmp_sw,$cols_commas_array);

                }else{
                    $swatch_Array[] = explode(",",",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,88,$product_image,$simple_color,0,0,,,,,,,,");
                
                }
        }
             

        $conf[$k] = array("configurable"=>$conf_temp_array[$k], "simple"=>$children_Array,"categories"=>$cat_Array,"swatches"=>$swatch_Array,"productimage"=>$confimg);


            $x++;
            }else{
                $cat_Array = array();
                $children_Array=array();
                $imagegallery=array();
                $swatch_Array=array();
                $xx=0;
                $k++;
                $x=0;
                
            }

        }

        }
        $i++;
        $j++;



        }



        fclose($file);
        $fp = fopen(ROOT.DS.'tmp'.DS.'download'.DS.'export.csv', 'w');
        $path = ROOT.DS.'tmp'.DS.'download'.DS.'export.csv';
        foreach ($keyArray as $fields) {

            
            if(!empty($fields)){
                try {
                $this->log("SIMPLE FIELDS :: ");
                if($useCol==0){
                    unset($fields[7]);
                }

                $str = implode(",",$fields);
                $arrstr = $fields;
                $this->log($str);    
                    if(is_array($fields)){
                        fputcsv($fp,$arrstr);
                    }
                } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            }
        }

        if(!empty($conf)){
            foreach ($conf as $key => $value) {

                 $this->log("CONF FIELDS :: ");
                 
                 $this->log($value['configurable']);
                 if($useCol==0){
                     unset($value['configurable'][7]);
                    }

                fputcsv($fp,$value['configurable']);

                 $this->log("CONF FIELDS :: ");
                $u = array_map('unserialize', array_unique(array_map('serialize', $value['categories'])));
                $p = array_map('unserialize', array_unique(array_map('serialize', $value['simple'])));
                $productimage = array_map('unserialize', array_unique(array_map('serialize', $value['productimage'])));
                $swatches = array_map('unserialize', array_unique(array_map('serialize', $value['swatches'])));
                
                foreach($u as $k=>$v){
                    $this->log("categories");
                    $this->log($v[7]);
                    if($useCol==0){
                     unset($v[7]);
                    }
                    fputcsv($fp,$v);
                }
                foreach($p as $k=>$v){
                    if($useCol==0){
                        $this->log("children");
                     unset($v[7]);
                    }
                    fputcsv($fp,$v);
                }
                foreach($productimage as $k=>$v){
                    if($useCol==0){
                        $this->log("productimage");
                        unset($v[7]);
                    }
                    fputcsv($fp,$v);
                }
                foreach($swatches as $k=>$v){
                    if($useCol==0){
                        $this->log("swatches");
                        unset($v[7]);
                    }
                    fputcsv($fp,$v);
                }
                

            }
        }



        fclose($fp);
        if(!$disableoutput){
            $this->response->file($path, array(
            'download' => true,
            'name' => 'magentoproduct.csv',
            ));
        }
       
        
    }
}
