<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Yummy Restaurant Login</title>
  <!-- 此<base>標籤設定文件中所有相對 URL 的基本 URL。這意味著，如果將其設為“/”，則所有相對 URL 都將從網域的根解析 -->
  <!-- <base href="../" /> -->
  <link rel="stylesheet" href="./static/css/style.css">
  <script src="./static/js/login.js"></script>
  <script src="./static/js/toast.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <!-- aria-live 表示該 <div> 內的內容可能會改變，並且屏幕閱讀器應該向用戶宣布這些更新。
        值為 "polite" 意味著更新會在下次可用的時機被宣布，不會打斷用戶的操作。 -->
  <!-- aria-atomic 如果內容的任何部分發生變化，則整個內容都會被宣布，而不是僅僅改變的部分。 -->
  <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center mt-5">
    <?php
    if (isset($_GET['userId'])) {
      echo '<div class="toast align-items-center text-white bg-danger border-1" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
              <div class="d-flex">
                <div class="toast-body">
                  Login Failed: UserId or password incorrect
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>';
    }
    ?>
  </div>
  <div class="login form-box">
    <div class="form-content">

      <h2>Yummy Restaurant Group Login</h2>
      <form action="login" method="POST" id="loginform">
        <!-- select user role -->
        <div class="ms-1">Select Role:</div>
        <span class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="role" id="supplier" autocomplete="off" value="supplier">
          <label class="btn btn-outline-dark w-100" for="supplier">Supplier</label>

          <input type="radio" class="btn-check" name="role" id="pm" autocomplete="off" value="pm">
          <label class="btn btn-outline-dark w-100" for="pm">Purchase Manager</label>
        </span>
        <!-- input user name -->
        <div class="input-field">
          <!-- 1. use null coalescing operator -->
          <!-- 2.  -->
          <input type="text" id="userId" name="userId" value="<?= htmlspecialchars($_GET['userId'] ?? '') ?>" autofocus required>
          <label for="userId">User Id</label>
        </div>
        <!-- input user password -->
        <div class="input-field">
          <input type="password" id="password" name="password" required>
          <label for="password">Password</label>
        </div>
        <button class="btn btn-primary w-100" onclick="validateForm()">Login</button>
      </form>
    </div>

  </div>

  <!-- <script>
        // 如果有提示框，則調用 showToast 函數
        document.addEventListener('DOMContentLoaded', function () {
          var toastElList = [].slice.call(document.querySelectorAll('.toast'));
          toastElList.forEach(function(toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show(); // 正確顯示提示框
          });
        });
  </script> -->
</body>

</html>