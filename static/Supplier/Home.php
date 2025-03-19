<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <!-- 此<base>標籤設定文件中所有相對 URL 的基本 URL。這意味著，如果將其設為“/”，則所有相對 URL 都將從網域的根解析 -->
    <!-- <base href="../" /> -->
    <link rel="stylesheet" href="././static/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary w-100 shadow-sm bg-body-tertiary">
        <!-- Navbar content -->
        <div class="container-fluid">

            <div class="main">
                Hi, <?php echo $_SESSION['username'] + ', ' + $_SESSION['role']; ?>
            </div>
</body>

</html>