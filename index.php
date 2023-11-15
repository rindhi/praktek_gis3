<!DOCTYPE html>
<html lang="en">
<head>
    <title>Praktek 1</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .fullscreen {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
        }

        .blok-info {
            z-index: 1000;
            top: 20px;
            cursor: pointer;
            right: 15px;
            position: absolute;
            border-radius: 15px;
            width: 200px;
            height: 300px;
            background: white;
            padding-left: 2px;
            padding-right: 25px;
            padding-top: 2px;
            padding-bottom: 2px;
        }
        
    </style>
</head>
<body>
    <div class="blok-info" id="blokhasil"></div>
    <div id="petaku" class="fullscreen"></div>
    <script>
        //mengatur generate map
        var hasilpeta = L.map('petaku').setView([-7.520267989872001, 112.23230114203787], 18);
        //mengatur datanya
        L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}',{maxZoom: 20,subdomains:['mt0','mt1','mt2','mt3']}).addTo(hasilpeta);

        $.getJSON("http://localhost/api_gis/api1.php", function(result){
            if(result.length > 0) {
                var dt = "";
                $.each(result, function(i, kolom){
                    let nama = kolom.nama;
                    let lintang = kolom.lintang;
                    let bujur = kolom.bujur; 
                    dt += `<li data-lintang="${lintang}" data-bujur="${bujur}" 
                        onclick="kelokasi (this)">${nama}</li>`
                    L.marker([lintang, bujur]).addTo(hasilpeta);
                });
                $("#blokhasil").html(`<ul>${dt}</ul>`);
            }

        });

        function kelokasi (el){
            let lintang = $(el).data("lintang");
            let bujur = $(el).data("bujur");
            hasilpeta.flyTo([lintang, bujur], 18);
        }
       
    </script>
</body>
</html>

