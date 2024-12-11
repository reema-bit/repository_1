<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

include "membersonly.inc.php";
$Members  = new isLogged(1);
$cdate = date('Y-m-d');
$date1 = date('Y-m-01');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include "links.php";
  ?>
  <title><?php echo $TITLE_; ?></title>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php
    include "header.php";
    ?>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <?php
      include "nav.php";
      ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">

      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-12">

              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <font size="5" color="#174aa1"><b>Stock Report</b></font>
                  </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="form" id="form" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>
                          <b>
                            <font color="#ed2618"></font> <b style="color:Tomato;">*</b>From Date:
                          </b>
                        </label>
                        <input type="date" id="fd" name="fd" class="form-control" value="<?php echo $date1; ?>" style="width:100%" required>
                      </div>

                      <div class="form-group col-md-4">
                        <label>
                          <b>
                            <font color="#ed2618"></font><b style="color:Tomato;">*</b> To Date:
                          </b>
                        </label>
                        <input type="date" id="td" name="td" class="form-control" value="<?php echo $cdate; ?>" style="width:100%">
                      </div>


                      <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="marital"> <b style="color:Tomato;">*</b>Select Product : </label>
                                                    <select class="form-control" name="prd_id" id="prd_id"  required>
                                                    <option value="">--All--</option>
                                                        <?php

                                                            $fld11['stat'] = '0';
                                                            $op11['stat'] = "=, and";

                                                        $fld11['sl'] = '0';
                                                        $op11['sl'] = ">, ";
                                                        $main_designation  = new Init_Table();
                                                        $main_designation->set_table("main_stk_product", "sl");
                                                        $groups = $main_designation->search_custom($fld11, $op11, '', array('sl' => 'ASC'));
                                                        foreach ($groups as $key => $ptps) {
                                                        ?>
                                                            <option value="<?php echo $ptps['sl']; ?>"><?= $ptps['prd_nm']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>                                                
                                                </div>
                                            </div> 


                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-right">

                <input type="button" class="btn btn-info" value="Export PDF" onclick="show2()"> 
                    <input type="button" class="btn btn-success" value="Search" onclick="show()">
                  </div>
                </form>
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <div id="show"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>




          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>




    <!-- /.content-wrapper -->
    <?php
    include "footer.php";
    ?>
  </div>
  <!-- ./wrapper -->

  <script type="text/javascript">
    // $(document).ready(function() {
    //   show();
    // });

    function show() {

      var fd = document.getElementById('fd').value;
      var td = document.getElementById('td').value;
      var prd_id = document.getElementById('prd_id').value;
  
 $('#show').load('stk_reports.php?fd=' + fd + '&td=' + td + '&prd_id=' + prd_id ).fadeIn('fast');
    


  }

    function show2() {
        var fd = document.getElementById('fd').value;
      var td = document.getElementById('td').value;
      var prd_id = document.getElementById('prd_id').value;
     
      window.open('stk_reports_pdf.php?fd=' + fd + '&td=' + td + '&prd_id=' + prd_id , '_blank');
    

  }
    function pagnt(pno) {
      var ps = document.getElementById('ps').value;

      var fd = document.getElementById('fd').value;
      var td = document.getElementById('td').value;
      var prd_id = document.getElementById('prd_id').value;
  

      $('#show').load('stk_reports.php?ps=' + ps + '&pno=' + pno + '&fd=' + fd + '&td=' + td + '&prd_id=' + prd_id ).fadeIn('fast');
      $('#pgn').val = pno;
    }

    function pagnt1(pno) {
      pno = document.getElementById('pgn').value;
      pagnt(pno);
    }



  

  </script>

</html>