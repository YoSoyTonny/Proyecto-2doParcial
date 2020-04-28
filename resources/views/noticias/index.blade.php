<!DOCTYPE html>

<html>
<head>
<title>Noticias</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->

<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="btmspace-80 center">
      <h3 class="nospace">Noticias</h3>
      <p class="nospace">Las noticias del día de hoy</p>
    </div>
    <ul class="nospace group services">
      @foreach($noticias as $noticia)
        <li class="one_third">
            <article class="bgded overlay" style="background-image:url('/storage/portadas/{{$noticia->portada}}');">
            <div class="txtwrap">
                <h6 class="heading">{{$noticia->titulo}}</h6>
                <p>{{substr($noticia->cuerpo,0,100)."..."}}</p>
            </div>
            <footer><a href="{{route('front.noticias.show',$noticia->id)}}">Leer mas &raquo;</a></footer>
            </article>
        </li>
      @endforeach
   
     
    </ul>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="/#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="/http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="/#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="/layout/scripts/jquery.min.js"></script>
<script src="/layout/scripts/jquery.backtotop.js"></script>
<script src="/layout/scripts/jquery.mobilemenu.js"></script>
<script src="/layout/scripts/jquery.flexslider-min.js"></script>
</body>
</html>