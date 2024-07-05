<?php
$p=$_POST['ddd'];
if($p=="ddd")
{
    $files = glob('./bookpic/*'); //get all file names

    foreach($files as $file)
    {
        if (is_file($file)) unlink($file); //delete previous files and images from the directory
    }
    $str='<div class="row"><div id="flipbook-viewport">
		<div id="flipbook">
			<div></div>
		</div>
		</div>
	</div>';
    echo json_encode($str);
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<!-- <script type="text/javascript" src="resources/jquery.js"></script> -->
	<script type="text/javascript" src="resources/turn3.js"></script>
	<script type="text/javascript" src="resources/flipbook.js"></script>
	<link type="text/css" rel="stylesheet" href="resources/flipbook.css">
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" onclick=" view_modal()">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:95%;max-width:100% !important;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>

<script>
    function view_modal() {

        $.ajax({
            type: "POST",
            url: "modal.php",
            dataType: "json",
            data: {'ddd':"ddd"},
            success: function(result) {
                $("#myModal").modal('show');
                $(".modal-body").html(result);

                load_ImageFlip("multipdf");
            
            }
        });
       



}
</script>