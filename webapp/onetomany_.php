<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>PHP</title>
</head>

<body>
    <div class="row">

        <div class="px-4 py-4 col-auto">
            <form action="action.php" method="post">
                <p>Book Form</p>
                <label>Code: </label>
                <input type="text" class="form-control" name="code" />
                <label>Title: </label>
                <input type="text" class="form-control" name="title" />
                <label>Author: </label>
                <input type="text" class="form-control" name="author" />
                <br />
                <input type="submit" name="add" value="ADD" />
            </form>
        </div>
    </div>
    <?php
    include("action.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <?php echo $deleteMsg ?? ''; ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($fetchData)) {
                                $sn = 1;
                                foreach ($fetchData as $data) {
                            ?>
                                    <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $data['code'] ?? ''; ?></td>
                                        <td><?php echo $data['title'] ?? ''; ?></td>
                                        <td><?php echo $data['author'] ?? ''; ?></td>
                                        <td>
                                            <i class="fa fa-car" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['code'] ?>" ></i>
            
                                            
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $data['code'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="action.php" method="post">
                                                    <div class="modal-body">
                                                        <label>Code: </label>
                                                        <input type="text" class="form-control" name="code" value="<?php echo $data['code'] ?? ''; ?>" readonly />
                                                        <br />
                                                        <label>Title: </label>
                                                        <input type="text" class="form-control" name="title" value="<?php echo $data['title'] ?? ''; ?>" />
                                                        <br />
                                                        <label>Author: </label>
                                                        <input type="text" class="form-control" name="author" value="<?php echo $data['author'] ?? ''; ?>" />
                                                        <br />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" name="update" class="btn btn-primary" value="Update" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $sn++;
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="8">
                                        <?php echo $fetchData; ?>
                                    </td>
                                <tr>
                                <?php
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <?php
    // }
    ?>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>