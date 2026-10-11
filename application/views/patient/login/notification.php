<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Notifications</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> All Notifications
                        </div>
                        <div class="panel-body">
                            <?php
                            if(!empty($notification)){
                                $i=1;
                                foreach($notification as $notifications){ ?>
                                    <div class="alert alert-info" style="margin-bottom: 10px;">
                                        <strong>#<?php echo $i;?>:</strong> <?php echo htmlspecialchars($notifications->notification_content);?>
                                        <?php if(!empty($notifications->notification_date)): ?>
                                            <span class="pull-right text-muted small"><i class="fa fa-clock-o"></i> <?php echo $notifications->notification_date;?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php
                                    $i++;
                                }
                            } else { ?>
                                <p class="text-muted">No notifications to display.</p>
                            <?php } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
<?php include 'assets/includes/footer.php';?>