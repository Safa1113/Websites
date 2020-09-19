function Reset1() {
var x=confirm("Do you want to Reset?");
if (x==true){
document.getElementById("form1").reset();}
}

/* -------------------------------------------------------------------- */

function Reset2(){
var x=confirm("Do you want to Reset?");
if (x==true){
document.getElementById("form2").reset();}
}

/* -------------------------------------------------------------------- */

function Reset3(){
var x=confirm("Do you want to Reset?");
if (x==true){
document.getElementById("form3").reset();}
}

function Reset4(){
var x=confirm("Do you want to Reset?");
if (x==true){
document.getElementById("form4").reset();}
}

/* -------------------------------------------------------------------- */

function validate1(){

  var a = document.getElementById("form1").FirstName.value;
    if (!isNaN(a)) {
      alert("Please Enter String First Name");
    return false;
    }
    var b = document.getElementById("form1").LastName.value;
      if (!isNaN(b)) {
        alert("Please Enter String Last Name");
      return false;
      }
      var c = document.getElementById("form1").email.value;

      if (! /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(c))
  {
	  alert("You have entered an invalid email address!")
    return (false)
  }
	alert("Added successfully");
	window.location.href="StudentHomePage.html";
  }
 /* -------------------------------------------------------------------- */

function validate2(){

  var a = document.getElementById("form2").title.value;
    if (!isNaN(a)) {
      alert("Please Enter String Title");
    return false;
    }
    var b = document.getElementById("form2").field.value;
      if (!isNaN(b)) {
        alert("Please Enter String Field");
      return false;
      }
      var c = document.getElementById("form2").description.value;

        if (!isNaN(c) || c=="Description of the course") {
          alert("Please fill the description");
        return false;
        }
        alert("Added successfully");
		window.location.href="InstructorHomePage.html";
}

/* -------------------------------------------------------------------- */

function dis(){
	  var x = document.getElementById("list");
	  if(x.style.display === "none")
		  x.style.display = "block";
	 else
		  x.style.display = "none";	  
  }