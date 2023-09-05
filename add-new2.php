<?php
include "db_conn2.php";

if (isset($_POST["submit"])) {
   $studentname = $_POST['studentname'];
   $bookname = $_POST['bookname'];
   $startdate= $_POST['startdate'];
   $enddate = $_POST['enddate'];

   $sql = "INSERT INTO `data1`(`id`, `studentname`, `bookname`, `startdate`,`enddate`) VALUES (NULL,'$studentname','$bookname','$startdate', '$enddate')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index2.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
$studentOptions = [];
$bookOptions = [];

$studentQuery = "SELECT `id`, `name` FROM `crud`";
$bookQuery = "SELECT `id`, `name` FROM `book`";

$studentResult = mysqli_query($conn, $studentQuery);
$bookResult = mysqli_query($conn, $bookQuery);

if ($studentResult && $bookResult) {
    while ($studentRow = mysqli_fetch_assoc($studentResult)) {
        $studentOptions[$studentRow['id']] = $studentRow['name'];
    }

    while ($bookRow = mysqli_fetch_assoc($bookResult)) {
        $bookOptions[$bookRow['id']] = $bookRow['name'];
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Student Data</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Student Data
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Student</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
         <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Student Name:</label>
                        <select class="form-select" name="studentname" id="studentname">
                            <option value="">Select an option</option>
                        </select>
                    </div>

                    <div class="col">
                        <label class="form-label">Book Name:</label>
                        <select class="form-select" name="bookname" id="bookname">
                            <option value="">Select an option</option>
                        </select>
                    </div>
                </div>

            <div class="mb-3">
               <div class="mb-3">
                  <label class="form-label">Start Date:</label>
                  <div class="input-group">
                     <input type="date" class="form-control" id="datepicker" name="startdate" placeholder="Select a date">
                  </div>
               </div>
            </div>
            <div class="mb-3">
               <div class="mb-3">
                  <label class="form-label">End Date:</label>
                  <div class="input-group">
                     <input type="date" class="form-control" id="datepicker" name="enddate" placeholder="Select a date">
                  </div>
               </div>
            </div>

            

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index2.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>





    
   <script>
        function populateDropdown(selectId, options) {
            const selectElement = document.getElementById(selectId);

            selectElement.innerHTML = '<option value="">Select an option</option>';

            for (const id in options) {
                if (options.hasOwnProperty(id)) {
                    const optionElement = document.createElement('option');
                    optionElement.value = options[id]; 
                    optionElement.textContent =id + ' - ' + options[id]; 
                    selectElement.appendChild(optionElement);
                }
            }
        }

        populateDropdown('studentname', <?php echo json_encode($studentOptions); ?>);
        populateDropdown('bookname', <?php echo json_encode($bookOptions); ?>);
    </script>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>