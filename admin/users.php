<!DOCTYPE html>
<html lang="en">

<head>
  <title>Users</title>
  <link rel="stylesheet" href="css/posts.css">
  <link rel="stylesheet" href="css/style2.css">
</head>

<body>
  <!-- Start Navbar -->
  <nav id='menu'>
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
    <ul>
      <li><a href=''>Home</a></li>
      <li><a class='dropdown-arrow' href=''>Posts</a>
        <ul class='sub-menus'>
          <li><a href=''>Posts List</a></li>
          <li><a href=''>Add Car</a></li>
        </ul>
      </li>
      <li><a class='dropdown-arrow' href='testimonials.php'>Users</a>
        <ul class='sub-menus'>
          <li><a href=''>Users List</a></li>
        </ul>
      </li>
      <li><a href='#'>Contact Us</a></li>
    </ul>
  </nav>
  <!-- End Navbar -->

  <div id="wrapper">
    <h1>Users</h1>

    <table id="keywords" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th><span>First Name</span></th>
          <th><span>Last Name</span></th>
          <th><span>Email</span></th>
          <th><span>Active</span></th>
          <th><span>Delete</span></th>
          <th><span>Update</span></th>
        </tr>
      </thead>

      <tbody>
        <?php
        include("oop.php");
        $db = new DB();
        $data = $db->select("*", "users");
        $row = $data->fetchAll(PDO::FETCH_ASSOC);
        if(isset($_POST['delete'])){
          $id=$_POST['id'];
          $db->delete("users","id='$id'");
        }
        foreach ($row as $user) { ?>
          <tr>
            <td class="lalign"><?php echo $user['firstName'] ?></td>
            <td><?php echo $user['secondName'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php if (isset($user['active'])) {
                  if ($user['active'] == 1) {
                    echo 'yes';
                  } else {
                    echo 'no';
                  }
                } ?></td>
            <td>
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <input type="submit" name="delete" value="delete">
              </form>
            </td>
            <td>
              <form action="updateUser.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <input type="submit" name="submit" value="update">
              </form>
            </td>
          </tr>
        <?php }
        ?>

      </tbody>
    </table>
  </div>
</body>

</html>