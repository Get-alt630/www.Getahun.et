<?php
$HostName="localhost";
$UserName="root";
$password="";
$databaseName="phprunner";
//lets connect it to the database
$connect=mysqli_connect(
$HostName,
$UserName,
$password,
$databaseName
);
// if($connect==false){
// echo"<script>alert(`Not connected to the database`)</script>";
// }
// else{
//     echo"<script>alert(`connected to the database`)</script>";
// }
if(isset($_POST['submit'])){
$fName=$_POST['fname'];
$MName=$_POST['Mname'];
$LName=$_POST['Lname'];
$Sex=$_POST['sex'];
$phone=$_POST['phone'];
//Inserting data into the table

$sql="INSERT INTO studregistration (firstName,MiddelName,LastName,Sex,Phone) values('$fName','$MName','$LName','$Sex','$phone')";
if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Data inserted successfully')</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($connect)."');</script>";
}
// fetch data from studregistration
if(isset($_POST['fetch_data'])){
$fetch="SELECT * FROM studregistration where FirstName ";
$knowResult=mysqli_query($connect,$fetch);
if(mysqli_num_rows($knowResult)>0){
   $row=mysqli_fetch_assoc($knowResult); 
echo $row['FirstName'];
}
else{
    echo"not worked";
}}else
{
    echo"<script>alert('please connect first')";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inserting data into the data base</title>
</head>
<body>
  <form action="StudRegistraion.php" method="post" style="margin-left: 9%;box-shadow:0 0 10px;width:30%;height:60%">
  <div style="margin-left: 7%;font-size:60px">
    <label for="fname">First Name</label><br>
    <input type="text" name ="fname" placeholder="your name"><br>
    <label for="Mname">Middel Name</label><br>
    <input type="text" name ="Mname" ><br>
    <label for="Lname">Last Name</label><br>
    <input type="text" name ="Lname" ><br>
    <label for="Sex">Sex</label>
    <select name="sex" id="" required><br>
        <option value=""></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br>
    <label for="phone">phone</label><br>
    <input type="tel" name ="phone" value="+251" id="phone" required><br>
    <button type="reset">Reset</button>
    <button type="button " name="submit"id="submit">Submit</button>
  
</form>
<button name="fetch_data"> Fetch data</button>
    <script>
function register(){
     let fname=document.getElementById("fname");
     fname.lowercase().charAt(0).touppercase();
     const Mname=document.getElementById("Mname");
     const Lname=document.getElementById("Lname");
    let submit=document.getElementById("submit");
    submit.addEventListener("click",()=>{
        submit.style.backgroundColor="rgb(22,56,100)";
        submit.style.color="white";
       
    });
}register();



    </script>
  </div>
  </form>  





<footer style="margin-top: 230px;margin-bottom:24px;">
    &copy;<?php echo "   ".date('d-m-y'." .  "); echo "All rights are reserved";?>
</footer>
</body>
</html>