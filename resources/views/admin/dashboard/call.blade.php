@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}

<style>
    html {
  font-size: 16px;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* General Container */

.general {
  width: 470px;
  height: 900px;
  margin: 30px auto 0 auto;
}

.buttons {
  width: 5px;
  height: 310px;
  margin: 150px 0 0 0;
  float: left;
}
/* BUTTONS */
.button {
  background: black;
  border-radius: 10px 0 0 10px;
  box-shadow: 2px 2px 25px rgb(160, 160, 160);
}

.button1 {
  width: 100%;
  height: 50px;
  border-left: 1px solid white;
}
.button2 {
  margin-top: 75px;
  width: 100%;
  height: 80px;
  border-left: 1px solid white;
}

.button3 {
  margin-top: 20px;
  width: 100%;
  height: 80px;
  border-left: 1px solid white;
}
.button4 {
  width: 5px;
  height: 100px;
  border-right: 1px solid rgb(182, 182, 182);
  margin-top: 300px;
  border-radius: 0 10px 10px 0;
  float: left;
}

/* PHONE */
.phone {
  float: left;
  width: 357px;
  height: 618px;
  background: black;
  border-radius: 60px;
  border: 9px solid black;
  box-shadow: 2px 2px 25px rgb(160, 160, 160);
}

.phone:after {
  content: "";
  position: absolute;
  /* z-index: 3; */
  margin-top: -602px;
  margin-left: -9px;
  width: 353px;
  height: 601px;
  border-radius: 60px;
  border: 2px solid rgb(163, 163, 163);
}

/* SCREEN */
.screen {
  width: 100%;
  height: 600px;
  z-index: 3;
  position: relative;
  display: flex;
  border-radius: 52px;
  justify-content: center;
  background-color: white;
  /*background: url(bg.jpg);
    background-size: cover; */
  overflow: hidden;
}

/* Front Camera */
.camera {
  position: absolute;
  z-index: 5;
  width: 90px;
  height: 26px;
  top: 12px;
  border: 1px solid black;
  background-color: black;
  border-radius: 15px;
  backdrop-filter: blur (5px);
}

.cam-r {
  position: absolute;
  width: 24px;
  height: 24px;
  background-color: rgb(0, 0, 0);
  border: 4px solid rgb(20, 20, 20);
  border-radius: 50%;
  top: 0px;
  left: 64px;
}

.fx-r-1 {
  position: absolute;
  width: 14px;
  height: 14px;
  top: 1px;
  left: 1px;
  border-radius: 50%;
  border-right: 1px solid rgb(6, 24, 126);
  background-color: rgb(10, 6, 39);
}

.fx-r-2 {
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  top: 2px;
  left: 2px;
  border-right: 1px solid rgb(29, 153, 143);
  border-bottom: 1px solid rgba(212, 0, 255, 0.479);
  background-color: rgba(95, 118, 131, 0);
}

.cam-l {
  position: absolute;
  width: 50px;
  height: 25px;
  background-color: rgb(0, 0, 0);
  border: 4px solid rgb(20, 20, 20);
  border-radius: 15px;
  top: 0px;
  left: 0px;
}

.fx-l-1 {
  position: absolute;
  width: 13px;
  height: 13px;
  top: 2px;
  left: 27px;
  border-radius: 50%;
  border-right: 1px solid rgb(49, 3, 3);
  background-color: rgb(24, 6, 6);
}

.fx-l-2 {
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  top: 2px;
  left: 2px;
  border-right: 1px solid rgb(104, 88, 1);
  border-top: 1px solid rgba(161, 53, 26, 0.479);
  background-color: rgba(95, 118, 131, 0);
}

/**/
#button-hangup:hover{
    box-shadow: 3px 1px 15px black;
}
.handle {
  width: 120px;
  height: 5px;
  border-radius: 50px;
  background-color: gray;
  position: absolute;
  bottom: 10px;
}
/*
.menu{
    position: absolute;
    width: 400px;
    height: 75px;
    background-color: rgb(0, 0, 0);
    bottom: 0px;;
}*/

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@push('title')
<title>Call to client </title>
@endpush
     {{-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Call</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                   Calling to clinet 
                  </li>
                </ol>
              </nav>
            </div>
          </div> --}}
           
<script src="https://kit.fontawesome.com/28e69471ea.js" crossorigin="anonymous"></script>


<div class="general">
  <div class="buttons">
    <div class="button button1"></div>
    <div class="button button2"></div>
    <div class="button button3"></div>
  </div>

  <div class="phone">
    <div class="screen">
        
     
        <div style="text-align: center;">
        <div style="margin-top:90px;">
           <div style="text-align:center;">
            <p style="font-size:22px; color:#008cff;"><b>{{$name}}</b></p>
            <p style="font-size: 16px;">{{$call_number}}</p>
           <div id="time"> <label id="minutes">00</label>:<label id="seconds">00</label></div>
        </div>
        </div>
        <button id="button-call"  class="btn btn-success" style="border-radius: 45px; margin-top: 280px; padding: 20px 45px 42px 50px; "> <i class="fa fa-phone" aria-hidden="true"></i></button>
          <button id="button-hangup"  class="btn btn-danger" style="border-radius: 45px; margin-top: 280px; padding: 20px 45px 42px 50px; display:none;"> <i class="fa fa-power-off" aria-hidden="true"></i></button>
            
        
        </div>
      <div class="camera">
        <div class="cam-l">
          <div class="fx-l-1">
            <div class="fx-l-2"></div>
          </div>
        </div>

        <div class="cam-r">
          <div class="fx-r-1">
            <div class="fx-r-2"></div>
          </div>
        </div>
      </div>

      <div class="menu"></div>
      <div class="handle"></div>
    </div>

  </div>
  <div class="button button4"></div>
</div>
</body>

</html>
          {{-- <div class="container">
               <div class="row">
                <div class="col-md-4 m-auto">
                    <div class="" style="border:7px solid #008cffad; box-shadow:15px 15px 35px; border-radius:30px; ">
                    <div class="display" style="border:1px solid #c3b5b5; height:250px; width:100%; border-radius:30px;"> 
                     </div>
                     <div class="row" style="text-align: center; height:150px;">
                        <div class="col-md-4 m-auto">
                            <div>
                                <button class="btn btn-success">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div>
                            </div>
                        </div>
                         <div class="col-md-4 m-auto">
                            <div>
                                <button class="btn btn-danger">Decline</button>
                            </div>
                        </div> 
                        <br> <br> <br>
                     </div>
                     </div>
                   
                </div>
               </div>
        </div> --}}
      {{-- THIS IS TWILIO  --}}
 <input type="hidden" id="phone-number" value="{{$call_number}}" type="text" placeholder="Type Phone Number.." required minlength="10" maxlength="15" />
<div id="controls">
    <div id="call-controls">
      <!--<button id="button-call" style="background-color: #0ab50a; cursor: grab;">Call</button>-->
      <!--<button id="button-hangup" style="background-color:red;  cursor: grab;">Hangup</button>-->
      
      
      <div id="volume-indicators">
        <label>Mic Volume</label>
        <div id="input-volume"></div><br /><br />
        <label>Speaker Volume</label>
        <div id="output-volume"></div>
      </div>
    </div>
    <div id="log"></div>
  </div>

    



 
@include('admin.dashboard.footer')
 <script type="text/javascript" src="{{url('twilio.min.js')}}"></script>
   <script src="{{url('jquery.min.js')}}"></script>
     <script src="{{url('quickstart.js')}}"></script>

 <script>


  $('#button-hangup').click(function(){
  $('#button-hangup').hide();
  $('#time').hide();
  $('#button-call').show();
  });
  
     $('#button-call').click(function(){
  $('#button-hangup').show();
  $('#time').show();
  $('#button-call').hide();
  });
  
  
    var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = 0;
setInterval(setTime, 1000);

function setTime() {
  ++totalSeconds;
  secondsLabel.innerHTML = pad(totalSeconds % 60);
  minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}

function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}

 </script>
