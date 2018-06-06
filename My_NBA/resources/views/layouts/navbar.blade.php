<?php
# @Author: alex
# @Date:   2017-12-10T06:59:37-05:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T06:30:49-05:00
?>
<nav id="header" class="navbar navbar-fixed-top">
  <div id="header-container" class="container navbar-container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a id="brand" class="navbar-brand" href="games">My NBA</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/teams">Teams</a></li>
        <li><a href="/players">Players</a></li>
        <li><a href="/games">Games</a></li>
        <li class="active"><a href="/edituser/{id}">Edit profil</a></li>
      </ul>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</nav><!-- /.navbar -->
<br />
@yield('navbar')
<style>
.navbar-brand {
  font-size: 24px;
}

/*.navbar-container {
padding: 20px 0 20px 0;
}*/

.navbar.navbar-fixed-top.fixed-theme {
  background-color: #222;
  border-color: #080808;
  box-shadow: 0 0 5px rgba(0,0,0,.8);
}

.navbar-brand.fixed-theme {
  font-size: 18px;
}

.navbar-container.fixed-theme {
  padding: 10;
}

.navbar-brand.fixed-theme,
.navbar-container.fixed-theme,
.navbar.navbar-fixed-top.fixed-theme,
.navbar-brand,
.navbar-container{
  background-color: #FFFFFF;
  transition: 0.8s;
  -webkit-transition:  0.8s;
}

.add{
  position: sticky;
  top : 15;
}

</style>
@yield('navbar')
