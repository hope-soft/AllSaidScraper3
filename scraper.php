<!DOCTYPE html>           
<html>
    <head>
        <title>UK Universities and Colleges</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <style type="text/css">
            html, body, #map_canvas {
                margin: 0;
                padding: 0;
                height: 100%;
            }
        </style>
        
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript">           
        var map;
        $(function(){
        var myOptions = {
            zoom: 10,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
        
        $.ajax({
            url: 'https://api.scraperwiki.com/api/1.0/datastore/sqlite?format=jsondict&name=uk_universities_and_colleges&query=select%20*%20from%20%60universities%60%20where%20latitude%20is%20not%20null',
            dataType: 'json',
            success: function(data){ drop_markers(data); }
        });
        function drop_markers(data){
            bounds = new google.maps.LatLngBounds();
            for(i = 0; i < data.length; i++){
                myLatLng = new google.maps.LatLng(data[i].latitude, data[i].longitude);
                markerOptions = {position: myLatLng, map: map, title: data[i].name};
                new google.maps.Marker(markerOptions);
                bounds.extend(myLatLng);
                map.fitBounds(bounds);
            }
        }
    });
  </script>
    </head>
    <body>
        <div id="map_canvas"></div>
    </body>
    </html>
    
<?php
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

// require 'scraperwiki.php';
// require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
