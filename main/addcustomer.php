<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
<form id="signup" action="main/savecustomer.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> New Customer</h4></center>
<hr>
<div id="ac" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
<span>Full Name : </span><input type="text" style="width:265px; height:30px;" name="name" placeholder="Full Name" Required/><br>
<span>Address : </span><input type="text" style="width:265px; height:30px;" name="address" placeholder="Address"/><br>
<span>Contact : </span><input type="number" style="width:265px; height:30px;" name="contact" placeholder="Contact" required/><br>
<span>Email </span><input type="email" style="width:265px; height:30px;" name="email" placeholder="Email"/><br>
<span>Birthdate: </span><input id="birthdate" type="date" style="width:265px; height:30px;" name="birthdate" placeholder="Date" required/><br>
<span>Username : </span><input type="text" style="width:265px; height:30px;" name="username" placeholder="username" required/><br>
<span>Password : </span><input id="pwd" type="password" style="width:265px; height:30px;" name="password" placeholder="Password" required onkeyup="checkPasswordMatch()"/><br>
<span>Confirm :</span><input id="cpwd" type="password" style="width:265px; height:30px;" name="Cpassword" placeholder="Password" required onkeyup="checkPasswordMatch()"/>
<p id="password-match" ></p>

<script>
function checkPasswordMatch() {
    var password = document.getElementById("pwd").value;
    var confirmPassword = document.getElementById("cpwd").value;
    var messageOk = document.getElementById("password-match");

    if (password == confirmPassword) {
        messageOk.style.color= "blue";
        messageOk.innerHTML = "Passwords match!";
    } else {
        messageOk.style.color= "red";
        messageOk.innerHTML = "Passwords do not match!";
    }
}
</script>
<br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>

</div>
</div>
</form>
<script>
  const form = document.getElementById('signup');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const birthdate = new Date(document.getElementById('birthdate').value);
    const age = new Date(Date.now() - birthdate.getTime()).getFullYear() - 1970;
    if (age < 16) {
      alert('You must be at least 16 years old to sign up.');
    } else {
      form.submit();
    }
  });
</script>
