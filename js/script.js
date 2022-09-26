//switch pages
const users = document.getElementById("userShow");
users.addEventListener("click", function() {
  document.getElementById("userSec").style.display = "flex";
  document.getElementById("heading").innerHTML = "users";
  document.getElementById("recsShow").style.display = "none";
  document.getElementById("set_show").style.display = "none";
    document.getElementById("home_page").style.display = "none";
});

const records = document.getElementById("recShow");
records.addEventListener("click", function() {
  document.getElementById("userSec").style.display = "none";
  document.getElementById("heading").innerHTML = "records";
  document.getElementById("recsShow").style.display = "flex";
    document.getElementById("home_page").style.display = "none";
  document.getElementById("set_show").style.display = "none";
});
const settings = document.getElementById("setShow");
settings.addEventListener("click", function() {
  document.getElementById("userSec").style.display = "none";
  document.getElementById("recsShow").style.display = "none";
  document.getElementById("heading").innerHTML = "Settings";
  document.getElementById("set_show").style.display = "flex";
  document.getElementById("home_page").style.display = "none";
});
const home = document.getElementById("homeShow");
home.addEventListener("click", function() {
  document.getElementById("userSec").style.display = "none";
  document.getElementById("recsShow").style.display = "none";
  document.getElementById("heading").innerHTML = "HomePage";
  document.getElementById("set_show").style.display = "none";
  document.getElementById("home_page").style.display = "flex";
});

document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };


var header = document.getElementById("navBar");
var btns = header.getElementsByClassName("navItem");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
