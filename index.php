<?php
$request = "";
if(isset($_GET["q"])){
    $request = $_GET["q"]; 
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="styles.css?<?=filemtime('styles.css');?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body onload="showResult(<?php if($request==''){echo '\''.$request.'\',0';}else{echo '\''.$request.'\',1';}?>)">
    <nav class="py-4 navbar navbar-expand-lg align-items-center justify-content-center">
        <div class="container-fluid align-items-center justify-content-center">
            <a style="font-size:3em;" class="white-text navbar-brand" href="index.php">
                <img src="images/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-center">
                Pokemon Database
                <img src="images/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-center">
              </a>

        </div>
      </nav>
    <div class="pt-5 container-fluid justify-content-center align-items-center">
        <div class="row justify-content-center align-items-center w-100 g-0">
            <form class="w-50">
                <input id="input" class="w-100"type="text" size="30" onkeyup="showResult(this.value,0)">
            
                
            </form>
            <div class="mt-5 justify-content-center align-items-center"id="livesearch">
              
            </div>
        </div>
        <div class="row mt-5 justify-content-center align-items-center w-100 g-0">
            <div id="DUform" class="col">
                <button onclick="deleteData();" id="btn">Delete</button>
                <button onclick="updateData();" id="btn">Update</button>
            </div>
            
        </div>
    </div>
    <?php 
                if(isset($_GET["q"])){
                    $request = $_GET["q"]; 
                    echo "<script type='text/javascript'>
                     document.getElementById('input').style.display='none';
                     document.getElementById('DUform').style.visibility='visible';
                    </script>";
                }?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        function showResult(str,st) {
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("livesearch").innerHTML=this.responseText;
            }
          }
          xmlhttp.open("GET","getdata.php?p="+st+"&q="+str,true);
          xmlhttp.send();
        }

        function hideInput(){
            document.getElementById("input").style.display='none';
        }

        function deleteData(){
            if (confirm("Are you sure you want to delete this Pokemon?")) {
                form = document.getElementById('myForm');
                inp = document.createElement("input");
                inp.setAttribute("id","action");
                inp.setAttribute("name","action");
                inp.setAttribute("value","delete");
                inp.setAttribute("type","hidden");
                form.appendChild(inp);
                form.submit();
            } else {
                
            }
            
        }
        function updateData(){
            form = document.getElementById('myForm');
            inp = document.createElement("input");
            inp.setAttribute("id","action");
            inp.setAttribute("name","action");
            inp.setAttribute("value","update");
            inp.setAttribute("type","hidden");
            form.appendChild(inp);
            form.submit();
        }

        </script>
</body>
</html>