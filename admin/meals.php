<!DOCTYPE html>
<html lang="en">

<head>
  <title>Meal</title>
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
    <h1>Posts</h1>

    <table id="keywords" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th><span>Title</span></th>
          <th><span>Price</span></th>
          <th><span>Family</span></th>
          <th><span>Size</span></th>
          <th><span>Delete</span></th>
          <th><span>Update</span></th>
        </tr>
      </thead>
      <tbody>
        <?php
        include("oop.php");
        $db = new DB();
        $db->_get();
        $data = $db->select("*", "meal");
        $row = $data->fetchAll(PDO::FETCH_ASSOC);
        if (isset($_POST["delete"])) {
          if (isset($row) && !empty($row)) {
            $id = $_POST['id'];
            $db->delete("meal", "id='$id'");
          }
        }
        foreach ($row as $meal) { ?>
          <tr>
            <td class="lalign"><?php echo $meal['title'] ?></td>
            <td><?php echo $meal['price'] ?></td>
            <td><?php echo $meal['family'] ?></td>
            <td><?php echo $meal['size']
                ?></td>
            <td>
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $meal['id'] ?>">
                <input type="submit" name="delete" value="delete">
              </form>
            </td>
            <td>
              <form action="updateMeals.php" method="post">
                <input type="hidden" name="id" value="<?php echo $meal['id'] ?>">
                <input type="submit" value="Edit">
              </form>
            </td>
          </tr>
        <?php
        } ?>
      </tbody>
    </table>
    <?php
    session_start();
    echo $_SESSION['firstName'];
    ?>
  </div>
</body>

</html>