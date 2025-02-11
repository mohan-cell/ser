
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    
    $data = json_decode(file_get_contents(__DIR__ . '/../src/data.json'), true);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['create'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $data[] = array('name' => $name, 'email' => $email);
            $jsonData = json_encode($data);
            file_put_contents(__DIR__ . '/../src/data.json', $jsonData);
            header('Location: ?');
            exit;
        } elseif (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            foreach ($data as $key => $value) {
                if ($key == $id) {
                    $data[$key]['name'] = $name;
                    $data[$key]['email'] = $email;
                }
            }
            $jsonData = json_encode($data);
            file_put_contents($jsonFile, $jsonData);
            header('Location: ?');
            exit;
        } elseif (isset($_POST['delete'])) {
            $id = $_POST['id'];
            foreach ($data as $key => $value) {
                if ($key == $id) {
                    unset($data[$key]);
                }
            }
            $jsonData = json_encode(array_values($data));
            file_put_contents($jsonFile, $jsonData);
            header('Location: ?');
            exit;
        }
    }
    ?>
    <div class="container mt-5">
        <h1>CRUD Operations</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) { ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $key; ?>">Update</button>
                        <form action="" method="post" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $key; ?>">
                            <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $key; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Record</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $key; ?>">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Name:</label>
                                        <input type="text" name="name" value="<?php echo $value['name']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">Email:</label>
                                        <input type="email" name="email" value="<?php echo $value['email']; ?>" class="form-control">
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <button type="submit" name="create" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
