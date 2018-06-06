<?php
# @Author: alex
# @Date:   2017-12-10T06:44:07-05:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T13:07:04-05:00
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <br />
  <br />
  @yield('start')
</body>
</html>
<style>
body{
background-size: 100% 100%;
background-image: url(http://www.basketwallpapers.com/Images-08/Andre-Iguodala-1680x1050-Widescreen-Wallpaper.jpg);
background-repeat: no-repeat;
}

.gallery-title
{
  font-size: 36px;
  color: #42B32F;
  text-align: center;
  font-weight: 500;
  margin-bottom: 70px;
}
.gallery-title:after {
  content: "";
  position: absolute;
  width: 7.5%;
  left: 46.5%;
  height: 45px;
  border-bottom: 1px solid #5e5e5e;
}
.filter-button
{
  font-size: 18px;
  border: 1px solid #42B32F;
  border-radius: 5px;
  text-align: center;
  color: #42B32F;
  margin-bottom: 30px;
}
.filter-button:hover
{
  font-size: 18px;
  border: 1px solid #42B32F;
  border-radius: 5px;
  text-align: center;
  color: #ffffff;
  background-color: #42B32F;
}
.btn-default:active .filter-button:active
{
  background-color: #42B32F;
  color: white;
}

.port-image
{
  width: 100%;
}

.gallery_product
{
  margin-bottom: 30px;
}
.form{
  margin-top : 5%;
  margin-left: 40%;
  margin-right:40%;
  width: 50%;
}
</style>
