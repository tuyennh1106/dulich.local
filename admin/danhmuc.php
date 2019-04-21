<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('includes/header.php');?>
<?php include('includes/top-header.php');?>
<?php include('includes/left-sidebar.php');?>

<div class="be-content">
    <div class="main-content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-table">
            <div class="card-header">Danh mục</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:50%;"><a href="danhmuc.php?sort=cat">Tên danh mục</a></th>
                            <th style="width:20%;"><a href="danhmuc.php?sort=by">Ngày Tạo</a></th>
                            <th class="number"><a href="danhmuc.php?sort=pos">Vị trí</a></th>
                            <th class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        //sap xep theo thu tu
                      if(isset($_GET['sort'])) {
                        switch ($_GET['sort']) {
                          case 'cat':
                            $order_by = 'danhmuc_ten';
                            break;

                          case 'pos':
                            $order_by = 'danhmuc_vitri';
                            break;

                          case 'by':
                            $order_by = 'danhmuc_ngaytao';
                            break;
                          
                          default:
                            $order_by = 'danhmuc_id';
                            break;
                        }
                      } else {
                        $order_by = 'danhmuc_id';
                      }

                        // truy vấn CSDL
                        $query = "SELECT * FROM danhmuc ORDER BY {$order_by} ASC";
                          if ($result = $dbc->query($query)) {
                              while ($danhmuc = $result->fetch_array(MYSQLI_ASSOC)) {
                                echo "
                                  <tr>
                                    <td>{$danhmuc['danhmuc_ten']}</td>
                                    <td>{$danhmuc['danhmuc_ngaytao']}</td>
                                    <td class='number'>{$danhmuc['danhmuc_vitri']}</td>
                                    <td class='actions'>
                                      <span style='padding:0 3px'>
                                      <a href='suadanhmuc.php?cid={$danhmuc['danhmuc_id']}' class='icon' href='#'><i class='mdi mdi-edit'></i></a>
                                      </span>
                                      <span style='padding:0 3px'>
                                      <a href='xoadanhmuc.php?cid={$danhmuc['danhmuc_id']}&danhmuc_ten={$danhmuc['danhmuc_ten']}' class='icon' href='#'><i class='mdi mdi-delete'></i>
                                      </a>
                                      </span>
                                    </td>
                                </tr>
                                ";
                              }
                          }
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
      </div>
    </div>
</div>

<?php include('includes/right-sidebar.php');?>
<?php include('includes/footer.php');?>