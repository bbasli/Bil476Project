<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script type="text/javascript">
        
        function showHeatmap(iid ,locations, check){
            //console.log("Locations: " , locations);
            if(check == 1){
                var id = "map" + iid;
                
                var element = document.getElementById(id);
                if(element){
                    element.display = "block";  
                    var map = L.map(id).setView([38.9597594, 34.9249653], 6);
                                    
                    var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',}).addTo(map);

                    var addressPoints = locations;
                    
                    addressPoints = addressPoints.map(function (p) { return [p[0], p[1]]; });

                    var heat = L.heatLayer(addressPoints, {minOpacity: 0.2, blur:15, radius: 40}).addTo(map);

                    var sid = "s"+iid
                    //console.log(sid);
                    document.getElementById(sid).innerText = 2020-iid+1;

                //console.log("SHOW MAP RUN");
                }else 
                    console.log("NO MAP FOUND");
            }else {
                //console.log("ALL SHOW MAO");
                var element = document.getElementById(iid);
                if(element){
                    element.display = "block";  
                    var map = L.map(iid).setView([38.9597594, 34.9249653], 6);
                                        
                        var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',}).addTo(map);

                        var addressPoints = locations;
                        
                        addressPoints = addressPoints.map(function (p) { return [p[0], p[1]]; });

                        var heat = L.heatLayer(addressPoints, {minOpacity: 0.2, blur:15, radius: 40}).addTo(map);

                        //console.log("SHOW MAP RUN");
                    }else 
                        console.log("NO MAP FOUND");
                }
            
        }

        function createDivz(startYear, endYear){
            if (startYear>=endYear){
                alert("Tutarlı aralık seçiniz.")
            }
            else{
                addMap(startYear,endYear)
            }
        }


        function showLineChart(id, dataPoints, products){

            var chart = new CanvasJS.Chart(id, {
                title: {
                    text: "Distribution of Products by Years"
                },
                axisY: {
                    title: "Number of Adulterated " + products
                },
                data: [{
                    type: "line",
                    dataPoints: dataPoints
                }]
            });
            chart.render();

        }

        function showDataPie(id, dataPoints){
            var chart = new CanvasJS.Chart(id, {
            animationEnabled: true,
            title: {
                text: "Distribution of Products by Citys"
            },
            subtitles: [{
                text: "2014-2020"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: dataPoints
            }]
            });
            chart.render();
         
        }

                        
</script>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <meta charset="UTF-8">
    <title>BIL476 PROJECT</title>
    <style>
        #map {
            margin-bottom: 25px;
        }
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        
        @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
        }

        body{
            padding: 50px;
        }
    </style>
</head>
<body>
<div class="column" id="wrapper" style="display: inline-flex; margin-left: : 50px;">
        <div style="width: 300px" class="column" id="filtreBlogu">
        <form style="display: block" class="form-group" action="showCharts.php" method="post">
            <h5 style="margin: 5px">Yıl aralığı seçiniz</h5>
            <h6 style="margin: 5px">(Tutarlı aralık seçin)</h6>
            <h6>Başlangıç yılı</h6>
            <select  class="form-control" style="width: 200px; margin: 5px" id="yıl1" name="syear">
                <option class="option" value="2014">2014</option>
                <option class="option" value="2015">2015</option>
                <option class="option" value="2016">2016</option>
                <option class="option" value="2018">2018</option>
                <option class="option" value="2019">2019</option>
                <option class="option" value="2020">2020</option>
            </select>
            <h6>Bitiş yılı</h6>
            <select class="form-control" style="width: 200px ; margin: 5px" id="yıl2" name="eyear">
                <option class="option" value="2020">2020</option>
                <option class="option" value="2019">2019</option>
                <option class="option" value="2018">2018</option>
                <option class="option" value="2016">2016</option>
                <option class="option" value="2015">2015</option>
                <option class="option" value="2014">2014</option>
            </select>
            <div>
                <h5> Ürün Kategorileri</h5>
                <div class="yiyecek"><input name="urunler[]" value="bal" type="checkbox">Bal</div>
                <div class="yiyecek"><input name="urunler[]" value="cikolata" type="checkbox">Çikolata</div>
                <div class="içecek"><input name="urunler[]" value="cay" type="checkbox">Çay,Kahve,Bitki Çayı</div>
                <div class="yiyecek"><input name="urunler[]" value="bitkisel" type="checkbox">Bitkisel Yağ ve Margarin</div>
                <div  class="both"><input name="urunler[]" value="sut"  type="checkbox">Süt ve Süt ürünleri</div>
                <div  class="yiyecek"><input name="urunler[]" value="et" type="checkbox">Et ve Et ürünleri</div>
                <div class="both"><input name="urunler[]" value="takviye" type="checkbox">Takviye Edici Gıdalar ve ürünler</div>
                <div class="both"><input name="urunler[]" value="diger" type="checkbox">Diğer Ürünler(Baharat,Kuruyemiş,Şekerli Mamül,Alkollü İçecekler)</div>
                <div class="both"><input name="urunler[]" value="tum" id="checkAll" type="checkbox">Bütün ürünler</div>

            </div>
            <button id="onayButonu" type="submit" name="submit" style="margin: 5px" class="btn btn-primary">Onayla</button>
    </form>
</div>
    <div style="width: 100%;height: 100%" id="chartDivs" class="container">
            <div id="heatMapDiv" style="width: 100%;height: 70%;">
                <div class="slideshow-container">
                    <a class="prev" style="position: relative;left: 50%" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" style="position: relative;left: 50%" onclick="plusSlides(1)">&#10095;</a>
                </div>
            </div>
            <div style="width: 1000px; height: 450px; margin-bottom: 25px; margin-left: 25px;">
                <span id="s1"></span>
                <div id="map1" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>

                <span id="s2"></span>
                <div id="map2" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>

                <span id="s3"></span>
                <div id="map3" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>

                <span id="s5"></span>
                <div id="map5" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>

                <span id="s6"></span>
                <div id="map6" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>

                <span id="s7"></span>
                <div id="map7" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>

                <span id="s4">2014 - 2020</span>
                <div id="all" style="width: 100%; height: 100%; margin-bottom: 15px;" class="map" ></div>
            
            </div>
            
    </div>
    


<?php

  include "connect_db.php";
  
  $all_locations = array();
  $all = array();

    if(isset($_POST['submit'])){
        if(isset($_POST['syear']) && isset($_POST['eyear']) && isset($_POST['urunler'])){
            $syear = $_POST['syear'];
            $eyear = $_POST['eyear'];
            $urunler = $_POST['urunler']; // ARRAY
            $lineDataPoints = array();

            $iller = array(
                "adana" => array("Adana" => 0),
                "adiy" => array("Adıyaman" => 0),
                "afyo" => array("Afyon" => 0),
                "agr" => array("Ağrı" => 0),
                "amas" => array("Amasya" => 0),
                "ankar" => array("Ankara" => 0),
                "antalya" => array("Antalya" => 0),
                "artvin" => array("Artvin" => 0),
                "aydin" => array("Aydın" => 0),
                "balik" => array("Balıkesir" => 0),
                "bilecik" => array("Bilecik" => 0),
                "bingol" => array("Bingöl" => 0),
                "bitlis" => array("Bitlis" => 0),
                "bolu" => array("Bolu" => 0), //safranboluyu sayıyor
                "burd" => array("Burdur" => 0),
                "burs" => array("Bursa" => 0),
                "canakk" => array("Çanakkale" => 0),
                "canki" => array("Çankırı" => 0),
                "coru" => array("Çorum" => 0),
                "denizli" => array("Denizli" => 0),
                "diyarb" => array("Diyarbakır" => 0),
                "edir" => array("Edirne" => 0),
                "elaz" => array("Elazığ" => 0),
                "erzincan" => array("Erzincan" => 0),
                "erzurum" => array("Erzurum" => 0),
                "eskis" => array("Eskişehir" => 0),
                "gazia" => array("Gaziantep" => 0),
                "giresun" => array("Giresun" => 0),
                "gumushane" => array("Gümüşhane" => 0),
                "hakkari" => array("Hakkari" => 0),
                "hatay" => array("Hatay" => 0),
                "ispa" => array("Isparta" => 0),
                "mers" => array("Mersin" => 0),
                "stan" => array("İstanbul" => 0),
                "zmir" => array("İzmir" => 0),
                "karsz" => array("Kars" => 0), // hiç ürün yok karsiyaka ile karışmasın diye z kondu
                "kastamonu" => array("Kastamonu" => 0),
                "kays" => array("Kayseri" => 0),
                "kirklareli" => array("Kırklareli" => 0),
                "kirs" => array("Kırşehir" => 0),
                "kocae" => array("Kocaeli" => 0),
                "kony" => array("Konya" => 0),
                "kutah" => array("Kütahya" => 0),
                "malat" => array("Malatya" => 0),
                "manisa" => array("Manisa" => 0),
                "kahramanm" => array("Kahramanmaraş" => 0),
                "mardin" => array("Mardin" => 0),
                "mugla" => array("Muğla" => 0),
                "musz" => array("Muş" => 0), // hiç ürün yok karışmasın diye z kondu
                "nev" => array("Nevşehir" => 0),
                "nigde" => array("Niğde" => 0),
                "ordu" => array("Ordu" => 0),
                "rize" => array("Rize" => 0),
                "sakarya" => array("Sakarya" => 0),
                "samsun" => array("Samsun" => 0),
                "siirt" => array("Siirt" => 0),
                "sinop" => array("Sinop" => 0),
                "sivas" => array("Sivas" => 0),
                "tekird" => array("Tekirdağ" => 0),
                "tokat" => array("Tokat" => 0),
                "trabzo" => array("Trabzon" => 0),
                "tunceli" => array("Tunceli" => 0),
                "urfa" => array("Şanlıurfa" => 0),
                "usak" => array("Uşak" => 0),
                "vanz" => array("Van" => 1),
                "yozgat" => array("Yozgat" => 0),
                "zong" => array("Zonguldak" => 0),
                "aksa" => array("Aksaray" => 0),
                "bayburt" => array("Bayburt" => 0),
                "karaman" => array("Karaman" => 0),
                "kirikkale" => array("Kırıkkale" => 0),
                "batman" => array("Batman" => 0),
                "irnak" => array("Şırnak" => 0),
                "bartin" => array("Bartın" => 0),
                "ardahan" => array("Ardahan" => 0),
                "igdir" => array("Iğdır" => 0),
                "yalova" => array("Yalova" => 0),
                "karabuk" => array("Karabük" => 0),
                "kilis" => array("Kilis" => 0),
                "osmaniye" => array("Osmaniye" => 0),
                "duzce" => array("Düzce" => 0),
            );

            foreach($iller as $key => $value){

                $sql_pie = "SELECT * FROM products WHERE address LIKE '%$key%'";
                if(!$pie_result = mysqli_query($conn, $sql_pie))
                    echo "Querry error: " . mysqli_error($conn);

                foreach ($iller[$key] as $key2 => $value2) {
                    $iller[$key][$key2] = mysqli_num_rows($pie_result);
                }
            }
            
            
            $temp = array();
            foreach (array_values($iller) as $key => $value) {
                foreach($value as $key2 => $value2)
                    $temp[$key2] = $value2;
            }
            
            asort($temp);

            $dataPie = array();
            $total_for_pie = 0;
            
            foreach ($temp as $key => $value) {
                array_push($dataPie, array("label"=> $key, "y"=>(100*$value/3833)));
            }

            array_splice($dataPie, 0, count($dataPie)-60);
            
            foreach (array_values($dataPie) as $element) {
                $total_for_pie += $element['y']*3833/100;
            }

            $others = 3833-$total_for_pie;
            array_push($dataPie, array("label"=>"Diğer", "y"=>(100*(3833-$total_for_pie)/3833)));
            
            for($year=2014; $year<=2020; $year++){

                $sql_line = "SELECT company FROM products WHERE document_date ='$year'";

                if(!$line_result = mysqli_query($conn, $sql_line))
                    echo "Querry Error: " . mysqli_error($conn);

                $row = mysqli_num_rows($line_result);
                if($row > 0)
                    array_push($lineDataPoints, array("y"=>$row, "label"=>$year));
            }

            for($year=intval($syear); $year<=intval($eyear); $year++ ){
                if($year == 2017) continue;
                $sql_heat = "SELECT latitude, longitude FROM products WHERE product_category LIKE '%$urunler[0]%' AND document_date='$year'";
                
                

                if(!$heat_result = mysqli_query($conn, $sql_heat))
                  echo "Querry Error: " . mysqli_error($conn);
                

                $locations = array();
                $location = array();
                
                    $products = mysqli_fetch_all($heat_result, MYSQLI_ASSOC);
                    foreach($products as $product){
                      if(!empty($product['latitude']) && !empty($product['longitude'])){
                        if(is_numeric($product['latitude']) && is_numeric($product['longitude'])){
                          array_push($location, floatval($product['latitude']), floatval($product['longitude']));
                          array_push($locations, $location);
                          array_push($all, $location);
                          unset($location);
                          $location = array();
                        }
                      }
                    }
                    $all_locations[intval($year)] = $locations;
                    unset($locations);
                    $locations = array();
            }
            $all_locations['all'] = $all;
            //echo "LLLLLLLLLLLLL</br>";
            if (count($dataPie) > 0) {
                ?> 
                <script type=text/javascript>
                    setTimeout(() => createDivz(0,1), 1000);
                    setTimeout(() => showDataPie("chart", <?php echo json_encode($dataPie, JSON_NUMERIC_CHECK); ?>), 1000);
                        
                 </script>
            <?php
            }
            if(count($lineDataPoints) > 0){
                ?> 
                <script type=text/javascript>
                    setTimeout(() => showLineChart("chart1", <?php echo json_encode($lineDataPoints, JSON_NUMERIC_CHECK); ?>, "Products"), 1000);
                    setTimeout(() => showHeatmap("all", <?php echo json_encode($all); ?>, 0), 1000);
                </script>
                <?php
            }
            if(count($all_locations) > 0) {
                //echo "HARITA";
                for($i=$syear; $i<=$eyear; $i++){
                    if($i == 2017) continue;
                    $index = ($eyear - $i+1);
                ?> 
                    <script type=text/javascript>
                        setTimeout(() => showHeatmap(<?php echo json_encode($index); ?>, <?php echo json_encode($all_locations[strval($i)]); ?>, 1), 1000);
                        //setTimeout(() => showHeatmap("map", <?php //echo json_encode($all); ?>, 5), 1000);
                    </script>
                <?php
              }
            }
        }else echo "BULAMADIII";
    }
     
?>
<script src="leaflet-heat.js"></script>
</body>
</html>
<script>
    let checkAll = document.getElementById("checkAll");
    checkAll.onclick=()=>{
        if(checkAll.checked){
            let elements=(document.getElementsByClassName("içecek"));
            for (item of elements) {
                if(item.style.display==="none"){
                }
                else{
                    item.firstChild.checked=true
                }
            }

            elements=(document.getElementsByClassName("yiyecek"));
            for (item of elements) {
                for (item of elements) {
                    if(item.style.display==="none"){

                    }
                    else{
                        item.firstChild.checked=true
                    }
                }
            }
            elements=(document.getElementsByClassName("both"));
            for (item of elements) {
                for (item of elements) {
                    if(item.style.display==="none"){

                    }
                    else{
                        item.firstChild.checked=true
                    }
                }
            }
        }
        else{
            let elements=(document.getElementsByClassName("both"));
            for (item of elements) {
                for (item of elements) {
                    if(item.style.display==="none"){

                    }
                    else{
                        item.firstChild.checked=false
                    }
                }
            }
            elements=(document.getElementsByClassName("içecek"));
            for (item of elements) {
                if(item.style.display==="none"){

                }
                else{
                    item.firstChild.checked=false
                }
            }

            elements=(document.getElementsByClassName("yiyecek"));
            for (item of elements) {
                for (item of elements) {
                    if(item.style.display==="none"){

                    }
                    else{
                        item.firstChild.checked=false
                    }
                }
            }
        }
    };
    let button = document.getElementById("onayButonu");
    let yiyecekler= ["Bal","Çikolata","Bitkisel Yağ ve Margarin","Süt ve Süt ürünleri","Et ve Et ürünleri"];
    let içecekler = ["Alkollü İçecekler","Alkolsüz İçecekler","Çay,Kahve,Bitki Çayı"];
    let takviyeEdiciGıdalar="Takviye Edici Gıdalar";
    
</script>
<script>
    let yıl1 = document.getElementById("yıl1");
    let yıl2 = document.getElementById("yıl2");
    yıl1.onclick =()=>{
        let yil1childs=yıl1.childNodes;
        console.log(yil1childs);
        for (item of yil1childs)
            if(item.className=="option")
                item.style.display="block";
    };
    yıl1.onchange = (ev)=>{
        // ev.preventDefault();
        yil1Value=yıl1.value;
        let yil2childs=yıl2.childNodes;
        console.log(yil2childs);
        for (item of yil2childs){
            if(item.className=="option"&&yil1Value>=item.innerText){
                item.style.display="none";
            }
            else if (item.className=="option"&&yil1Value<item.innerText){
                item.style.display="block";
            }
        }
    }

    yıl2.onchange = (ev)=>{
        // ev.preventDefault();
        yil2Value=yıl2.value;
        let yil1childs=yıl1.childNodes;

        for (item of yil1childs){
            if(item.className=="option"&&yil2Value<item.innerText){
                item.style.display="none";
            }
            else if (item.className=="option"&&yil2Value>=item.innerText){
                item.style.display="block";
            }
        }
    }
</script>
<script>
    function addMap(startYear,endYear) {
        let divs = [];
        counter = 0 ;
        for (let i = startYear; i<=endYear ; i++) {
            if(i==2017){

            }
            else{
                let div =  createMapDivs(i);
                let childNodes = div.childNodes;
                childNodes[0].innerText = (counter+1) +"/"+(endYear-startYear+1);
                if(counter!=0)
                    childNodes[1].id = "chart"+counter;
                else
                    childNodes[1].id = "chart";
                //childNodes[2].innerText = i+"";
                counter++;
                divs.push(div);
            }
        }
        for (item of divs){
            document.getElementsByClassName("slideshow-container")[0].insertBefore(item,document.getElementsByClassName("slideshow-container")[0].firstChild);
        }
        console.log( document.getElementsByClassName("prev")[0]);
        document.getElementsByClassName("prev")[0].click();
    }
    function createMapDivs(year){
        let mySlidesFade = document.createElement("div");
        mySlidesFade.className = "mySlides";
        let numberText = document.createElement("div");
        numberText.className = "numberText";
        let mapDiv = document.createElement("div");
        mapDiv.className = "mapDiv";
        mapDiv.style.width="100%";
        mapDiv.style.height="550px";
        //mapDiv.style.backgroundColor="blue";
        let text = document.createElement("div");
        text.className = "text";
        mySlidesFade.appendChild(numberText);
        mySlidesFade.appendChild(mapDiv);
        mySlidesFade.appendChild(text);
        return mySlidesFade;
    }
</script>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        
        if(slides[slideIndex-1] != undefined)
            slides[slideIndex-1].style.display = "block";
    }
</script>
