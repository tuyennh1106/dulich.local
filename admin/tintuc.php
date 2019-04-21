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
            <div class="card-header">Tin tức</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" style="font-size: 13px">
                    <thead>
                        <tr>
                            <th style="width:20%;"><a href="tintuc.php?sort=name">Tên tin tức</a></th>
                            <th style="width:10%;"><a href="tintuc.php?sort=cat">Danh mục</a></th>
                            <th>Nội dung</th>
                            <th style="width:95px;" class="actions">Ảnh đại diện</th>
                            <th style="width:85px;" class="actions"><a href="tintuc.php?sort=hot">Tin nổi bật</a></th>
                            <th style="width:80px;" class="actions"><a href="tintuc.php?sort=by">Ngày tạo</a></th>
                            <th style="width:75px;" class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        //sap xep theo thu tu
                      if(isset($_GET['sort'])) {
                        switch ($_GET['sort']) {
                          case 'name':
                            $order_by = 'tintuc_ten';
                            break;

                          case 'cat':
                            $order_by = 'danhmuc_ten';
                            break;

                          case 'hot':
                            $order_by = 'tintuc_hot';
                            break;

                          case 'by':
                            $order_by = 'date';
                            break;
                          
                          default:
                            $order_by = 'tintuc_id';
                            break;
                        }
                      } else {
                        $order_by = 'tintuc_id';
                      }

                        // truy vấn CSDL
                        $query = "SELECT t.tintuc_id, t.tintuc_ten, t.tintuc_noidung, t.tintuc_anh, DATE_FORMAT(t.tintuc_ngaytao, '%d/%m/%y') AS date, t.tintuc_hot, d.danhmuc_ten ";
                        $query .= " FROM tintuc AS t";
                        $query .= " JOIN danhmuc AS d";
                        $query .= " USING (danhmuc_id)";
                        $query .= " ORDER BY {$order_by} ASC";
                          if ($result = $dbc->query($query)) {
                            $status = array(0 => 'Không', 1 => 'có');
                            while ($tintucs = $result->fetch_array(MYSQLI_ASSOC)) {
                              echo "
                                <tr>
                                  <td>".the_excerpt($tintucs['tintuc_ten'], 50)."</td>
                                  <td>".the_excerpt($tintucs['danhmuc_ten'], 50)."</td>
                                  <td>".the_excerpt($tintucs['tintuc_noidung'], 200)."</td>
                                  <td class='actions'><img src='uploads/images/{$tintucs['tintuc_anh']}' alt='{$tintucs['tintuc_ten']}' width='95px' height='95px'></td>
                                  <td class='actions'>".$status[($tintucs['tintuc_hot'])]."</td>
                                  <td class='actions'>{$tintucs['date']}</td>
                                  <td class='actions'>
                                    <span style='padding:0 3px'>
                                    <a href='suatintuc.php?tid={$tintucs['tintuc_id']}' class='icon' href='#'><i class='mdi mdi-edit'></i></a>
                                    </span>
                                    <span style='padding:0 3px'>
                                    <a href='xoatintuc.php?tid={$tintucs['tintuc_id']}&tintuc-ten={$tintucs['tintuc_ten']}' class='icon'><i class='mdi mdi-delete'></i>
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