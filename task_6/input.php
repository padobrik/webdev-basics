<html>
<head>
  <style>
    * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    }
    body {
        background-color: #ffffff;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .input-container {
        position: center;
        background-color: #2c8df6;
        width: 550px;
        height: 300px;
        border-radius: 15px;
    }
    input {
        outline: none;
        border: none;
        background-color: #ffffff;
        position: static;
        width: 210px;
        height: 50px;
        color: #000000;
        font-size: 22px;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
        z-index: 3;
        border-radius: 5px;
    }
    h2 {
        margin-top: 40px;
        margin-bottom: 10px;
        text-align: center;
        font-size: 32;
        font-weight: bold;
        font-family: sans-serif;
    }
    p {
      margin-top: 10px;
      margin-bottom: 10px;
      text-align: center;
      font-size: 26;
      font-weight: bold;
      font-family: sans-serif;
    }
    p span {
      padding-top: 20px;
      text-align: center;
      font-weight: 200;
    }
  </style>
  <script>
    function showHint(str) {
      if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest(); // new request to the server
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText; // print output to the server
          }
        };
        xmlhttp.open("GET", "output.php?word=" + str, true);
        xmlhttp.send();
      }
    }
  </script>
</head>
<body>
  <div class='input-container'>
    <form name = 'predictor' action="">
      <h2 align="center"> Predictor</h2>
      <input type="text" name="name" onkeyup="showHint(this.value)" id='input' placeholder="Input">
    </form>
    <p>
      Output:
      <br>
      <span id="txtHint"></span>
    </p>
  </div>
</body>
</html>