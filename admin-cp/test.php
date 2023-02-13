<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <link
    href="https://cdn.jsdelivr.net/gh/mortezaom/google-sans-cdn@master/fonts.css"
    rel="stylesheet"
  />
  <title>Checkbox</title>

  <style>
    body {
      font-family: "Google Sans";
    }

    .containerSwitch {
      display: flex;
      align-items: center;
      position: relative;
      height: 44px;
      gap: 10px;
      overflow: hidden;
    }
    .containerSwitch::before, .containerSwitch::after {
      content: "";
      position: absolute;
      width: auto;
      height: 10px;
    }

    .containerSwitch.loading .switch {
      pointer-events: none;
    }
    .containerSwitch.loading .switch .slider {
      width: 25px;
      background-color: #9b999b;
    }
    .containerSwitch.loading .switch .slider::before {
      border: 3px solid #9b999b;
      border-top: 3px solid #6174f0;
      bottom: 0;
      right: 0;
      left: 0;
    }
    .containerSwitch.active .switch .slider::before {
      right: 3px;
      left: unset;
    }
    .containerSwitch.active.loading .switch .slider::before {
      right: 0px;
      left: unset;
    }
    
    .switch {
      position: relative;
      display: flex;
      justify-content: center;
      height: 25px;
      width: 40px;
    }
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .switch .slider {
      position: absolute;
      z-index: 10;
      cursor: pointer;
      width: 100%;
      height: 100%;
      background-color: #e1413e;
      transition: all .3s ease-in-out
    }
    .switch .slider::before {
      content: "";
      position: absolute;
      height: 19px;
      width: 19px;
      left: 3px;
      bottom: 3px;
      background-color: rgb(241, 241, 241);
      transition: .3s ease;
      transition-property: background-color;
      animation: spin 1s ease infinite;
    }
    .containerSwitch.active .switch  .slider.round {
      background-color: #1bc665;
    }
    .switch .slider.round {
      border-radius: 19px;
      box-shadow: 2px 2px 5px rgb(0, 0, 0, .1);
    }
    .switch .slider.round::before {
      border-radius: 50%;
    }

    @keyframes spin {
      from {
        transform: rotate(0deg);
      } to {
        transform: rotate(360deg);
      }
    }
  </style>
</head>
<body>
  <div class="containerSwitch" id="switch1">
    <label class="switch">
      <input type="checkbox">
      <span class="slider round"></span>
    </label>
    
  </div>

  <div class="containerSwitch" id="fullSwitch"><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div>

  <script>
    document.querySelector("#switch1 input").addEventListener("change", function() {
      let containerSwitch = document.querySelector("#switch1");
      let checked = this.checked;
      let loading = true;

      containerSwitch.classList.add("loading");
      //document.body.style.backgroundColor = "#D8DDFF";
      
      var obj = {user_id: id};
      data = jQueryRequest("togglePublicChat",obj,function callback(data){
        console.log(data);
      });


      setTimeout(() => {
        loading = false;
        containerSwitch.classList.remove("loading");
        if(checked) {
          containerSwitch.classList.add("active");
          //document.body.style.backgroundColor = "#FFDEDE";
        } else {
          containerSwitch.classList.remove("active");
          //document.body.style.backgroundColor = "#DEFCEB";
        }
      }, 1000)
    });

    document.querySelector("#fullSwitch input").addEventListener("change", function() {
      let containerSwitch = document.querySelector("#fullSwitch");
      let checked = this.checked;
      let loading = true;

      containerSwitch.classList.add("loading");
      //document.body.style.backgroundColor = "#D8DDFF";
      
      setTimeout(() => {
        loading = false;
        containerSwitch.classList.remove("loading");
        if(checked) {
          containerSwitch.classList.add("active");
          //document.body.style.backgroundColor = "#FFDEDE";
        } else {
          containerSwitch.classList.remove("active");
          //document.body.style.backgroundColor = "#DEFCEB";
        }
      }, 1000)
    })

  </script>
</body>
</html>

<?php
die;
?>

<!-- GRADIENT SPINNER -->
<div class="spinner-box">
  <div class="circle-border">
    <div class="circle-core"></div>
  </div>  
</div>

<!-- SPINNER ORBITS -->
<div class="spinner-box">
  <div class="blue-orbit leo">
  </div>

  <div class="green-orbit leo">
  </div>
  
  <div class="red-orbit leo">
  </div>
  
  <div class="white-orbit w1 leo">
  </div><div class="white-orbit w2 leo">
  </div><div class="white-orbit w3 leo">
  </div>
</div>

<!-- GRADIENT CIRCLE PLANES -->
<div class="spinner-box">
  <div class="leo-border-1">
    <div class="leo-core-1"></div>
  </div> 
  <div class="leo-border-2">
    <div class="leo-core-2"></div>
  </div> 
</div>

<!-- SPINNING SQUARES -->
<div class="spinner-box">
  <div class="configure-border-1">  
    <div class="configure-core"></div>
  </div>  
  <div class="configure-border-2">
    <div class="configure-core"></div>
  </div> 
</div>

<!-- LOADING DOTS... -->
<div class="spinner-box">
  <div class="pulse-containerSwitch">  
    <div class="pulse-bubble pulse-bubble-1"></div>
    <div class="pulse-bubble pulse-bubble-2"></div>
    <div class="pulse-bubble pulse-bubble-3"></div>
  </div>
</div>

<!-- SOLAR SYSTEM -->
<div class="spinner-box">
  <div class="solar-system">
    <div class="earth-orbit orbit">
      <div class="planet earth"></div>
      <div class="venus-orbit orbit">
        <div class="planet venus"></div>
        <div class="mercury-orbit orbit">
          <div class="planet mercury"></div>
          <div class="sun"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Three Quarter Spinner -->

<div class="spinner-box"><div class="three-quarter-spinner"></div></div>

<style>
    /* KEYFRAMES */

@keyframes spin {
  from {
    transform: rotate(0);
  }
  to{
    transform: rotate(359deg);
  }
}

@keyframes spin3D {
  from {
    transform: rotate3d(.5,.5,.5, 360deg);
  }
  to{
    transform: rotate3d(0deg);
  }
}

@keyframes configure-clockwise {
  0% {
    transform: rotate(0);
  }
  25% {
    transform: rotate(90deg);
  }
  50% {
    transform: rotate(180deg);
  }
  75% {
    transform: rotate(270deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes configure-xclockwise {
  0% {
    transform: rotate(45deg);
  }
  25% {
    transform: rotate(-45deg);
  }
  50% {
    transform: rotate(-135deg);
  }
  75% {
    transform: rotate(-225deg);
  }
  100% {
    transform: rotate(-315deg);
  }
}

@keyframes pulse {
  from {
    opacity: 1;
    transform: scale(1);
  }
  to {
    opacity: .25;
    transform: scale(.75);
  }
}

/* GRID STYLING */

* {
  box-sizing: border-box;
}

body {
  min-height: 100vh;
  background-color: #1d2630;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  align-items: flex-start;
}

.spinner-box {
  width: 300px;
  height: 300px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: transparent;
}

/* SPINNING CIRCLE */

.leo-border-1 {
  position: absolute;
  width: 150px;
  height: 150px;
  padding: 3px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  background: rgb(63,249,220);
  background: linear-gradient(0deg, rgba(63,249,220,0.1) 33%, rgba(63,249,220,1) 100%);
  animation: spin3D 1.8s linear 0s infinite;
}

.leo-core-1 {
  width: 100%;
  height: 100%;
  background-color: #37474faa;
  border-radius: 50%;
}

.leo-border-2 {
  position: absolute;
  width: 150px;
  height: 150px;
  padding: 3px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  background: rgb(251, 91, 83);
  background: linear-gradient(0deg, rgba(251, 91, 83, 0.1) 33%, rgba(251, 91, 83, 1) 100%);
  animation: spin3D 2.2s linear 0s infinite;
}

.leo-core-2 {
  width: 100%;
  height: 100%;
  background-color: #1d2630aa;
  border-radius: 50%;
}

/* ALTERNATING ORBITS */

.circle-border {
  width: 150px;
  height: 150px;
  padding: 3px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  background: rgb(63,249,220);
  background: linear-gradient(0deg, rgba(63,249,220,0.1) 33%, rgba(63,249,220,1) 100%);
  animation: spin .8s linear 0s infinite;
}

.circle-core {
  width: 100%;
  height: 100%;
  background-color: #1d2630;
  border-radius: 50%;
}

/* X-ROTATING BOXES */

.configure-border-1 {
  width: 115px;
  height: 115px;
  padding: 3px;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #fb5b53;
  animation: configure-clockwise 3s ease-in-out 0s infinite alternate;
}

.configure-border-2 {
  width: 115px;
  height: 115px;
  padding: 3px;
  left: -115px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgb(63,249,220);
  transform: rotate(45deg);
  animation: configure-xclockwise 3s ease-in-out 0s infinite alternate;
}

.configure-core {
  width: 100%;
  height: 100%;
  background-color: #1d2630;
}

/* PULSE BUBBLES */

.pulse-containerSwitch {
  width: 120px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.pulse-bubble {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #3ff9dc;
}

.pulse-bubble-1 {
    animation: pulse .4s ease 0s infinite alternate;
}
.pulse-bubble-2 {
    animation: pulse .4s ease .2s infinite alternate;
}
.pulse-bubble-3 {
    animation: pulse .4s ease .4s infinite alternate;
}

/* SOLAR SYSTEM */

.solar-system {
  width: 250px;
  height: 250px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.orbit {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #fafbfC;
  border-radius: 50%;
} 

.earth-orbit {
  width: 165px;
  height: 165px;
  -webkit-animation: spin 12s linear 0s infinite;
}

.venus-orbit {
  width: 120px;
  height: 120px;
  -webkit-animation: spin 7.4s linear 0s infinite;
}

.mercury-orbit {
  width: 90px;
  height: 90px;
  -webkit-animation: spin 3s linear 0s infinite;
}

.planet {
  position: absolute;
  top: -5px;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: #3ff9dc;
}

.sun {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background-color: #ffab91;
}

.leo {
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}

.blue-orbit {
  width: 165px;
  height: 165px;
  border: 1px solid #91daffa5;
  -webkit-animation: spin3D 3s linear .2s infinite;
}

.green-orbit {
  width: 120px;
  height: 120px;
  border: 1px solid #91ffbfa5;
  -webkit-animation: spin3D 2s linear 0s infinite;
}

.red-orbit {
  width: 90px;
  height: 90px;
  border: 1px solid #ffca91a5;
  -webkit-animation: spin3D 1s linear 0s infinite;
}

.white-orbit {
  width: 60px;
  height: 60px;
  border: 2px solid #ffffff;
  -webkit-animation: spin3D 10s linear 0s infinite;
}

.w1 {
  transform: rotate3D(1, 1, 1, 90deg);
}

.w2 {
  transform: rotate3D(1, 2, .5, 90deg);
}

.w3 {
  transform: rotate3D(.5, 1, 2, 90deg);
}

.three-quarter-spinner {
  width: 50px;
  height: 50px;
  border: 3px solid #fb5b53;
  border-top: 3px solid transparent;
  border-radius: 50%;
  animation: spin .5s linear 0s infinite;
}
</style>