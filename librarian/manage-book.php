<?php require_once 'header.php'; ?>
<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
            <li></i><a href="javascript:avoid(0)">Manage Book</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Books</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <th>Author Name</th>
                                <th>Publication Name</th>
                                <th>Purchase Date</th>
                                <th> Price</th>
                                <th>Book Qty</th>
                                <th>Available Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = mysqli_query($con,"SELECT * FROM books");
                                while ($row = mysqli_fetch_assoc($result)) {
                             ?>
                            <tr>
                                <td><?= $row['book_name'] ?></td>
                                <td><img src="../images/books/<?= $row['book_image'] ?>" alt="" style="width: 50px">
                                </td>
                                <td><?= $row['book_author_name'] ?></td>
                                <td><?= $row['book_publication_name'] ?></td>
                                <td><?= date('y-M-Y',strtotime($row['book_purchase_date'] )) ?></td>
                                <td><?= $row['book_price'] ?></td>
                                <td><?= $row['book_qty'] ?></td>
                                <td><?= $row['available_qty'] ?></td>
                                <td>
                                    <a href="javascript:avoid(0)" class="btn btn-info" data-toggle="modal"
                                        data-target="#book-<?= $row['id'] ?>"><i class="fa fa-eye"></i></a>
                                    <a href="book-update" data-toggle="modal"
                                        data-target="#book-update<?= $row['id'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                    <a href="delete.php?bookdelete=<?= base64_encode($row['id']) ?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete')"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            <?php
                                     }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
         $result = mysqli_query($con,"SELECT * FROM books");
         while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="modal fade" id="book-<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-info"></i>Book Info</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Book Name</th>
                            <td><?= $row['book_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Book Image</th>
                            <td><img src="../images/books/<?= $row['book_image'] ?>" alt="" style="width: 50px">
                             </td>
                        </tr>
                        <tr>
                             <th>Author Name</th>
                             <td><?= $row['book_author_name'] ?></td>
                        </tr>
                        <tr>
                               <th>Publication Name</th>
                               <td><?= $row['book_publication_name'] ?></td>
                        </tr>
                        <tr>
                           <th>Purchase Date</th>
                           <td><?= date('y-M-Y',strtotime($row['book_purchase_date'] )) ?></td>
                        </tr>
                        <tr>
                           <th> Price</th>
                           <td><?= $row['book_price'] ?></td>
                        </tr>
                        <tr>
                          <th>Book Qty</th>
                          <td><?= $row['book_qty'] ?></td>
                        </tr>
                        <tr>
                           <th>Available Qty</th>
                           <td><?= $row['available_qty'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                   <!--  <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
       }
      ?>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <?php
         $result = mysqli_query($con,"SELECT * FROM books");
         while ($row = mysqli_fetch_assoc($result)) {
           $id = $row['id'];
           $book_info = mysqli_query($con,"SELECT * FROM books where id = '$id'");
           $book_info_row = mysqli_fetch_assoc($book_info);
        ?>
    <div class="modal fade" id="book-update<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-info"></i>Update Book Info</h4>
                </div>
                <div class="modal-body">
                   <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="">
                                     <div class="form-group">
                                            <label for="book_name">Book Name</label>
                                                <input type="text" name="book_name" class="form-control" id="book_name" placeholder="Book Name" value="<?= $book_info_row['book_name']?>" required>
                                                <input type="hidden" name="id" class="form-control" value="<?= $book_info_row['id']?>" required>
                                        </div>
                                    <!--      <div class="form-group">
                                         <label for="book_image">Book Image</label>
                                                <input type="file" id="book_image" name="book_image" accept="image/*"  value="<?= $book_info_row['book_image']?>" required>
                                                <img style="width: 70px; height: 70px;" src="../images/books/<?= $book_info_row['book_image']?>">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="book_publication_name">Publication Name</label>
                                                <input type="text" name="book_publication_name" class="form-control" id="book_publication_name" placeholder="Book Publication Name" value="<?= $book_info_row['book_name']?>" required>
                                        </div>
                                         <div class="form-group">
                                    <label for="book_author_name">Author Name</label>
                                                <input type="book_author_name" name="book_author_name" class="form-control" id="book_author_name" placeholder="Book Author Name" value="<?= $book_info_row['book_author_name']?>" required>
                                        </div>
                                         <div class="form-group">
                                            <label for="book_purchase_date">Purchase Date</label>
                                                <input type="date" id="book_purchase_date" value="" name="book_purchase_date" class="form-control" required=""
                                                placeholder="DD-MM-YY" value="<?= $book_info_row['book_purchase_date']?>" required>
                                        </div>
                                         <div class="form-group">
                                        <label for="book_price">Book Price</label>
                                                <input type="number" class="form-control" id="book_price" name="book_price" value="<?= $book_info_row['book_price']?>" placeholder="Book Price" required>
                                        </div>
                                         <div class="form-group">
                                        <label for="book_qty">Book Quantity</label>
                                                <input type="number" class="form-control" id="book_qty" name="book_qty" value="<?= $book_info_row['book_qty']?>" placeholder="Book Quantity" required>
                                        </div>
                                         <div class="form-group">
                                            <label for="available_qty">Available Quantity</label>
                                                <input type="number" class="form-control" id="available_qty" name="available_qty" placeholder="Available Quantity" value="<?= $book_info_row['available_qty']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <button style="float: right;" type="submit" name="update-book" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php
       }

if (isset($_POST['update-book'])) {
   $id = $_POST['id'];
   $book_name = $_POST['book_name'];
   $book_author_name = $_POST['book_author_name'];
   $book_publication_name = $_POST ['book_publication_name'];
   $book_purchase_date = $_POST['book_purchase_date'];
   $book_price = $_POST['book_price'];
   $book_qty = $_POST['book_qty'];
   $available_qty = $_POST['available_qty'];
   $libraian_username = $_SESSION['libraian_username'];

   // $image = explode('.',$_FILES['book_image']['name']);
   // $image_ext = end($image);
   
   // $image = date('Ymdhis.') . $image_ext;


   
   $result = mysqli_query($con, $query = "UPDATE `books` SET`book_name`='$book_name',`book_author_name`='$book_author_name',`book_publication_name`='$book_publication_name',`book_purchase_date`='$book_purchase_date',`book_price`='$book_price',`book_qty`='$book_qty',`available_qty`='$available_qty',`libraian_username`='$libraian_username', WHERE id='$id'");

   if ($result){

   }
   }
      ?>
    <?php require_once 'footer.php'; ?>