<!DOCTYPE HTML>
<!--
  Spectral by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
  <head>
    <title>Медобори</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link rel="stylesheet" href="assets/css/main.css" />


  </head>
  <body class="landing">
<?php

require "lib.php"; // move all DB work outside

?>
    <!-- Page Wrapper -->
      <div id="page-wrapper">

        <!-- Header -->
          <header id="header" class="alt">
            <h1><a href="index.html">Медобори</a></h1>
            <nav id="nav">
              <ul>
                <li class="special">
                  <a href="#menu" class="menuToggle"><span></span></a>
                  <div id="menu">
                    <ul>
                      <li><a href="#galery">Галерея</a></li>
                      <li><a href="#menuu">Меню</a></li>
                      <li><a href="#contacts">Контакт</a></li>
                      <li><a href="printD.php">Log In</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </nav>
          </header>

        <!-- Banner -->
          <section id="banner">
            <div class="inner">
              <h2>Медобори</h2>
              <p>Якіта пару слів<br />
              які пафосно звучать	</p>
              <ul class="actions">
                <li><a href="#" class="button special">Замовити бенкет</a></li>
              </ul>
            </div>
          </section>

        <!-- galery -->
          <section id="galery" class="wrapper style1 special">
            <div class="inner galery">
              <header class="major">
                <h2>Галерея</h2>
              </header>
              <div>
                <button class="display-left" onclick="plusDivs(-1)">&#10094;</button>
                <button class="display-right" onclick="plusDivs(1)">&#10095;</button>

                <br>
                <div style="text-align:center">
                  <span class="dot" onclick="showDivs(slideIndex=1)"></span>
                  <span class="dot" onclick="showDivs(slideIndex=2)"></span>
                  <span class="dot" onclick="showDivs(slideIndex=3)"></span>
                  <span class="dot" onclick="showDivs(slideIndex=4)"></span>
                  <span class="dot" onclick="showDivs(slideIndex=5)"></span>
                </div>

                <div class="galery-conntainer">
                  <img class="mySlides" src="images/snapshot2.png" onclick="plusDivs(1)">
                  <img class="mySlides" src="images/snapshot1.png" onclick="plusDivs(1)">
                  <img class="mySlides" src="images/snapshot3.png" onclick="plusDivs(1)">
                  <img class="mySlides" src="images/snapshot4.png" onclick="plusDivs(1)">
                  <img class="mySlides" src="images/snapshot5.png" onclick="plusDivs(1)">
                </div>

            </div>
                <script>
                  var slideIndex = 1;
                  showDivs(slideIndex);

                  function plusDivs(n) {
                    showDivs(slideIndex += n);
                  }

                  function showDivs(n) {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    if (n > x.length) {slideIndex = 1}
                    if (n < 1) {slideIndex = x.length}
                    for (i = 0; i < x.length; i++) {
                      x[i].style.display = "none";
                    }
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < dots.length; i++) {
                      dots[i].className = dots[i].className.replace(" active", "");
                    }
                    x[slideIndex-1].style.display = "inline";
                    dots[slideIndex-1].className += " active";

                  }
                </script>
            </div>
          </section>

        <!-- menu -->
          <section id="menuu" class="wrapper  style3 special">
            <div class="inner">
              <header class="major">
                <h2>Меню</h2>
                <p>тут буде згенероване меню з коротким описом <br>без цін, можливо з фотками</p>
              </header>
              
                <?php
                        

                $result=sendSql("SELECT * FROM dish ORDER BY Name ASC;"); 


                if($result->num_rows > 0)
                {
                //good it's time to create table
                //header
                    echo ("<div class=\"ingr_table\" id=\"ingTbl\" ><table>
                    <tr>
                    <th>Страва</th>
                    <th>Ціна</th> 
                    </tr>");
                //rows

                    while($row = $result->fetch_assoc())
                    {
                    $price = calculateDish($row);

                    echo("<tr class='passive'>
                    <td>".$row['Name']." </td>
                    <td>".$row['Price']." грн </td>
                   
                    </tr>");     
                    }
                    echo ("</table></div>");
                }


                ?>
              
            </div>

          </section>

        <!-- contacts -->
          <section id="contacts" class="wrapper style2 special">
            <div class="inner">
              <header class="major">
                <h2>Контакти</h2>
              </header>
              <ul class="actions">
                <li><a href="#" class="button special">Замовити бенкет</a></li>
              </ul>
             
             
              <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyB7joyx-4tEedGYRS0cLRpGDor2XwBJCc8'></script>
              <div style='overflow:hidden;height:400px;width:320px; display: table; margin: 0 auto;padding: 1em 0'>
                <div id='gmap_canvas' style='height:400px;width:320px;color:black'></div>
                <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
              </div> <br><br>
              <p><strong>Кафе-бар <br>Медобори</strong><br>м.Львів <br>пр.Червоної Калини 102 <br>"Санта-Барбара"</p>
           
              <script type='text/javascript'>
                function init_map(){
                  var myOptions = {
                    zoom:15,
                    center:new google.maps.LatLng(49.7878,24.058457800000042),
                    mapTypeId: google.maps.MapTypeId.ROADMAP};
                  map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                  marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(49.7846526,24.0588)});
                  infowindow = new google.maps.InfoWindow({
                    content:'<strong style="color:red">Медобори</strong><br>Червоної калини 102<br> <br>'});
                  google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});
                  infowindow.open(map,marker);}
                  
                google.maps.event.addDomListener(window, 'load', init_map);
              </script>
          <!-- other map   
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d607.8722532426515!2d24.058273002543405!3d49.78469516937329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473ae8678523a8e3%3A0x9abb06a5be8f639f!2z0JzQtdC00L7QsdC-0YDQuA!5e0!3m2!1suk!2sua!4v1528476557033&z=15" width="300" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div> -->
          </section>



        <!-- Footer -->
          <footer id="footer">
            <ul class="icons">
              <li><a href="https://www.google.com.ua/maps/place/%D0%9C%D0%B5%D0%B4%D0%BE%D0%B1%D0%BE%D1%80%D0%B8/@49.7846526,24.0565778,17z/data=!4m5!3m4!1s0x473ae8678523a8e3:0x9abb06a5be8f639f!8m2!3d49.7846526!4d24.0587665"
                    class="icon fa-google"><span class="label">Map</span></a></li>
              <li><a href="https://www.facebook.com/medoboru" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
              <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
              <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>

            </ul>
            <ul class="copyright">
              <li>&copy; Medobory</li><li>Template by: <a href="http://html5up.net">HTML5 UP</a></li>
            </ul>
          </footer>

      </div>

    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollex.min.js"></script>
      <script src="assets/js/jquery.scrolly.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>

  </body>
</html>






























