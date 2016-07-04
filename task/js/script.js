function swaplogin() { 
      $("#login").collapse('hide');
 
}
function swapsignup() { 
      $("#signup").collapse('hide');
}

var value ="user";
function getvalue() {
  return value;

}
 function switchadminToActive () {
  
  var classes = document.querySelector("#user-btn").className;
  classes = classes.replace(new RegExp("active", "g"), "");
  document.querySelector("#user-btn").className = classes;
  
  classes = document.querySelector("#admin-btn").className;
  if (classes.indexOf("active") == -1) {
    classes += " active";
    document.querySelector("#admin-btn").className = classes;
  }
    document.querySelector("#ldomain").value = "admin";
  
}
function switchuserToActive () {

  var classes = document.querySelector("#admin-btn").className;

  classes = classes.replace(new RegExp("active", "g"), " ");
  document.querySelector("#admin-btn").className = classes;
  classes = document.querySelector("#user-btn").className;
  if (classes.indexOf("active") == -1) {
    classes += "active";
    document.querySelector("#user-btn").className = classes;
  }
  document.querySelector("#ldomain").value = "user";
  }
  function switchadminToActive1 () {
  
  var classes = document.querySelector("#user-btn1").className;
  classes = classes.replace(new RegExp("active", "g"), "");
  document.querySelector("#user-btn1").className = classes;
  
  classes = document.querySelector("#admin-btn1").className;
  if (classes.indexOf("active") == -1) {
    classes += " active";
    document.querySelector("#admin-btn1").className = classes;
  }
    document.querySelector("#sdomain").value = "admin";
  
}
function switchuserToActive1 () {

  var classes = document.querySelector("#admin-btn1").className;

  classes = classes.replace(new RegExp("active", "g"), " ");
  document.querySelector("#admin-btn1").className = classes;
  classes = document.querySelector("#user-btn1").className;
  if (classes.indexOf("active") == -1) {
    classes += "active";
    document.querySelector("#user-btn1").className = classes;
  }
  document.querySelector("#sdomain").value = "user";
  }
    