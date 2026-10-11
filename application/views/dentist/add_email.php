<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> add email</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <form method="POST">
                    enter email<input type="email" name="dentist_email">
                    <input type="submit" value="add">
                </form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include 'assets/includes/footer.php';?>