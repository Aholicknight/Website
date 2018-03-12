state = 0;

var name = "";
var dob = "";
var phone = "";
var health = "";
var prov = "";
var medical = "";
var shirt = "";

var parent_name = "";
var parent_phone = "";
var parent_email = "";

var github_username = "";

var week1 = false;
var week2 = false;

function first() {
  $("#start").slideUp();
  $("#first").slideDown();
  $("#buttons").slideDown();
  state = 1;
}

function returning() {
  $("#start").slideUp();
  $("#returning").slideDown();
  $("#buttons").slideDown();
  state = 100;
}

function prev() {
  switch(state) {
    case 1:
    case 100:
      $("#start").slideDown();
      $("#first").slideUp();
      $("#returning").slideUp();
      $("#buttons").slideUp();
      state = 0;
      break;
    case 2:
      $("#parent").slideUp();
      $("#first").slideDown();
      state = 1;
      break;
    case 3:
      $("#parent").slideDown();
      $("#github").slideUp();
      $("#github-button").hide();
      $("#next-button").show();
      break;
  }
}

function validateEmail(id) {
    email = $(id).val();
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String(email).toLowerCase())) {
      $(id).parent().addClass("has-error");
      return true;
    }
    $(id).parent().removeClass("has-error");
    return false;
}

function checkInput(id) {
  if ($(id).val() == "") {
    $(id).parent().addClass("has-error");
    return true;
  }
  $(id).parent().removeClass("has-error");
  return false;
}

function next() {
  switch(state) {
    case 1:
      name = $("#name").val();
      dob = $("#dob").val();
      phone = $("#cellphone").val();
      health = $("#health").val();
      prov = $("#prov").val();
      medical = $("#medical").html();
      shirt = $("#shirt").val();
      var error = checkInput("#name");
      error     = checkInput("#dob")    || error;
      error     = checkInput("#health") || error;
      if (!error) {
        $("#first").slideUp();
        $("#parent").slideDown();
        state = 2;
      }
      break;
    case 2:
      parent_name = $("#parent_name").val();
      parent_phone = $("#parent_phone").val();
      parent_email = $("#parent_email").val();
      var error = checkInput("#parent_name");
      error     = checkInput("#parent_phone") || error;
      error     = checkInput("#parent_email") || error;
      error     = validateEmail("#parent_email") || error;
      if (!error) {
        $("#parent").slideUp();
        $("#github").slideDown();
        $("#github-button").show();
        $("#next-button").hide();
        state = 3;
      }
      break;
    case 3:
      $("#github").slideUp();
      $("#github-select").slideDown();
      $("#buttons").slideUp();
      state = 4;
      break;
    case 4:
      $("#github-select").slideUp();
      $("#github-create").slideDown();
      $("#buttons").slideDown();
      $("#prev-button").hide();
      $("#github-button").hide();
      $("#next-button").show();
      state = 5;
      break;
    case 5:
      github(7);
      state = 6;
      break;
    case 7:
      $("#week-select").slideDown();
      $("#github-done").slideUp();
      state = 8;
      break;
    case 8:
      week1 = $("#week-1").val();
      week2 = $("#week-2").val();
      if (!week1 && !week2) {
        break;
      }
      $("#week-select").slideUp();
      $("#payment").slideDown();
      state = 9;
      break;


    case 101:
      $("#github-done").slideUp();
      $("#confirm-info").slideDown();
      break;
  }
}

var interval;
var github_finish_state = 7;

function github(finish_state) {
  popup = window.open('github-js.php','GitHub Registration','width=600,height=800');
  $("#github-select").slideUp();
  $("#github-create").slideUp();
  $("#buttons").slideUp();
  $("#github-wait").show();
  interval = setInterval(githubCheck, 500);
  github_finish_state = finish_state;
}

function githubCheck() {
  if (popup.opener === null) {
    clearInterval(interval);
    setTimeout(function(){
      $.get("includes/registration/github.php",function(data){
        console.log(data);
        if (data !== "__") {
          githubDone(data);
        } else {
          github(github_finish_state);
        }
      });
    }, 1000);
  }
}

function githubDone(username) {
  github_username = username;
  clearInterval(interval);
  $("#prev-button").hide();
  $("#github-button").hide();
  $("#next-button").show()
  $("#buttons").show()
  $("#github-wait").slideUp();
  $("#github-done").slideDown();
  $("#github-username").html(username);
  state = github_finish_state;
}
