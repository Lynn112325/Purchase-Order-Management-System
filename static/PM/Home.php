<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Home Page</title>
  <!-- 此<base>標籤設定文件中所有相對 URL 的基本 URL。這意味著，如果將其設為“/”，則所有相對 URL 都將從網域的根解析 -->
  <!-- <base href="../" /> -->
  <?php
  require_once './static/components/head.php';
  require_once './static/components/pm/sidebar.php';
  require_once './static/components/header.php';
  ?>
</head>

<body>
  <div class="container-fluid">
    <!-- Header -->
    <div class="header row">
      <?php render_header(); ?>
    </div>
    <!-- Sidebar -->
    <div class="row p-2 pe-4">
      <?php render_sidebar(); ?>
      <!-- Content -->
      <div class="main col-10 p-4">
        Hi, <?php echo $_SESSION['username'] . ', ' . $_SESSION['role']; ?>
      </div>
    </div>
  </div>

</body>

</html>