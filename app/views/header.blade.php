@section('header')
<style>
    .navbar-nav li{
        padding-right: 40px;
        
    }
</style>

<nav class="navbar navbar-default" role="navigation">
    <div class="container">
     <div class='row'><h3 class="text-center text-warning text-info" style="font-family: lato">MBEYA REFFERAL HOSPTAL CANCER REGISTRY</h3>
  
  </div>
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <!--<a class="navbar-brand" href="#"><i class='fa fa-home fa-3x text-info'></i></a>-->
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><i class='fa fa-wheelchair fa-3x text-info'></i> Patients</a></li>
      <li><a href="#"><i class='fa fa-bar-chart-o fa-3x text-info'></i> Reports</a> </li>
      <li><a href="#"><i class='fa fa-gear fa-3x text-info'></i> Setup</a> </li>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#" title="help"><i class='fa fa-question-circle fa-3x text-info'></i> Help</a></li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-md fa-3x text-info"></i> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#" title="view your profile"><i class="fa fa-user"></i> Profile</a></li>
            <li><a href="#" title="change password"><i class="fa fa-lock"></i> Change Password</a></li>
          <li class="divider"></li>
          <li><a href="#" title="logout"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
    </div>
</nav>
<script>
$(document).ready(function(){
    $("#topnavs li").hide().hover(function(){
        $(this).addClass("btn btn-warning");
    },function (){
        $(this).removeClass("btn btn-warning");
    });
});
</script>
@show