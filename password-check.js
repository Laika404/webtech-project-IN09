var check = function() {
  if (document.getElementById("pass").value ==
    document.getElementById("pass-repeat").value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Wachtwoorden zijn gelijk';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Wachtwoorden zijn niet gelijk';
  }
}
