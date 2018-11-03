<?php
namespace clusterdev;
function getlink($url){
    
    $tracking= "venkataki";
    $flpkrturl=$url;
    $headers = array(
	            'Cache-Control: no-cache',
	            'Fk-Affiliate-Id:venkataki',
	            'Fk-Affiliate-Token:ca3cf1eb2af34671b6e46372315db2e0'
	            );
      $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-ClusterDev-Flipkart/0.1');
	        curl_setopt($ch, CURLOPT_TIMEOUT, 45);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$server_output = curl_exec($ch);
curl_close($ch);
$result = json_decode($server_output,TRUE);
    return $result ? $result : false;
}

$link = "https://affiliate-api.flipkart.net/affiliate/api/venkataki.json";
$produc = getlink($link);

$ver = "v1.1.0";
$cat = "mobiles";

$link = $produc['apiGroups']['affiliate']['apiListings'][$cat]['availableVariants'][$ver]['get'];

echo '<br>Link For Mobiles Category - > '.$link;
$produc = getlink($link);

$next = $produc['nextUrl'];
echo '<br>Link For Mobiles Category Next - > '.$next;
echo "<br>";


$count = 0;
while($next){

   $product = $produc['productInfoList'];
//Basic Info
$k=0;
    $brand = $product[0]['productBaseInfoV1']['productBrand'];
    $product_url = $product[0]['productBaseInfoV1']['productUrl'];


    $title = $product[0]['productBaseInfoV1']['title'];
    $product_id = $product[0]['productBaseInfoV1']['MOBDZ3Q7D8Q9HVCP'];
    $product_desc = $product[0]['productBaseInfoV1']['productDescription'];
    $image = $product[0]['productBaseInfoV1']['imageUrls']['400x400'];
    $mrp = $product[0]['productBaseInfoV1']['maximumRetailPrice']['amount'];
    $price = $product[0]['productBaseInfoV1']['flipkartSellingPrice']['amount'];
    $discount_percent = $product[0]['productBaseInfoV1']['discountPercentage'];

//Attributes
    $att_color = $product[0]['productBaseInfoV1']['attributes']['color'];
    $att_storage = $product[0]['productBaseInfoV1']['attributes']['storage'];
    $att_rating = $product[0]['productShippingInfoV1']['sellerAverageRating'];
    $att_NoOfRatings = $product[0]['productShippingInfoV1']['sellerNoOfRatings'];
// Key Specs
    $keyspecs0 = $product[0]['categorySpecificInfoV1']['keySpecs'][0];
    $keyspecs1 = $product[0]['categorySpecificInfoV1']['keySpecs'][1];
    $keyspecs2 = $product[0]['categorySpecificInfoV1']['keySpecs'][2];
    $keyspecs3 = $product[0]['categorySpecificInfoV1']['keySpecs'][3];
    $keyspecs4 = $product[0]['categorySpecificInfoV1']['keySpecs'][4];

//Full Specifications
$need = $product[$k]['productBaseInfoV1']['productId'];
while($need){
$val = $product[$k]['categorySpecificInfoV1']['specificationList'][0]['key'];
$j=0;
while($val){
$key = $product[$k]['categorySpecificInfoV1']['specificationList'][$j]['values'][0]['key'];
$i=0;
    echo "<br><br>Category Name : ".$key;
    echo " <br> - - - - - - - - - - -- - - - - -- - - - - -- - - - - - -- - - - - - - -- - - -- - - - - -- - - - - - -- - - - -- - - - -- - - - - - - - - - -- - - - - -- - - - - -- - - - - - -- - - - - - - -- - - -- - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
while($key){
    $spec_name = $product[$k]['categorySpecificInfoV1']['specificationList'][$j]['values'][$i]['key'];
    $spec_value = $product[$k]['categorySpecificInfoV1']['specificationList'][$j]['values'][$i]['value'][0];
    echo "<br>".$spec_name." \t : ".$spec_value;
    
    $i++;
    $key = $product[$k]['categorySpecificInfoV1']['specificationList'][$j]['values'][$i]['key'];
}
    $j++;
    $val = $product[$k]['categorySpecificInfoV1']['specificationList'][$j]['key'];
} 
    $count++;
    echo "<center><br>End Of Product ".$count."</center><hr>";
    $k++;
    $need = $product[$k]['productBaseInfoV1']['title'];
    echo "<br>".$need;
}
    $link = $next;
    $produc = getlink($link);
    $next = $produc['nextUrl'];
}
echo "<br>".$count;
echo "DONE ";




//print_r(json_encode($result));
?>