
<?php
$key = "TiyMZxRbh4vc2ZZCNtHMe7FSYjMU2uGn2iryP_wb2n4";
$curl = curl_init();
if(isset($_GET['categoria'])){
    if($_GET['categoria']==""){
        $dati = array(  "page"=>rand(1,10),
                        "query"=>"pattern",
                        "orientation"=>"squarish",
                        "content_filter"=>"high",
                        "per_page"=>5);
        $dati = http_build_query($dati);
        $url="https://api.unsplash.com//search/photos/?".$dati;
        $headers= array("Content-Type: text/html","Authorization: Client-ID ".$key);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result= curl_exec($curl);
        echo $result;
        curl_close($curl);
        exit;
    } else{
        $dati = array(  "page"=>1,
                        "query"=>$_GET['categoria'],
                        "orientation"=>"squarish",
                        "content_filter"=>"high",
                        "per_page"=>5);
        $dati = http_build_query($dati);
        $url="https://api.unsplash.com//search/photos/?".$dati;
        $headers= array("Content-Type: text/html","Authorization: Client-ID ".$key);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result= curl_exec($curl);
        echo $result;
        curl_close($curl);
        exit;
    }
}
?>