<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> weekly reports</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <form method="POST">
	                <p>enter the latest date you wish to see the weekly report upto that date.</p>
	                Enter date:<input type="date" name="appointment_date">
	                <input type="submit" value="show">
	                <input type="reset" value="reset">
                </form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include 'assets/includes/footer.php';?>