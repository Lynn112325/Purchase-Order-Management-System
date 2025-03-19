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
    <script src="./static/js/formHandler.js" defer></script>
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
                <!-- index -->
                <div class="row">


                </div>
                <div class="row">
                    <!-- Select Target Restaurant -->
                    <div class="col-4">
                        <label for="restaurant" class="form-label">Target Restaurant</label>
                        <select class="form-select" name="restaurant" id="restaurant" aria-label="Select Target Restaurant">
                            <option value="" selected>Select Target Restaurant</option>
                            <?php
                            foreach ($viewData as $restaurant): ?>
                                <option value="<?= htmlspecialchars($restaurant->getId()) ?>"
                                    data-type="<?= htmlspecialchars($restaurant->getType()) ?>"
                                    data-address="<?= htmlspecialchars($restaurant->getAddress()) ?>">
                                    <?= htmlspecialchars($restaurant->getRestaurantName()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Restaurant Detail (Type, Address) -->
                    <div class="col-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" readonly>
                    </div>
                    <div class="col-5">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" readonly>
                    </div>
                    <!--  -->
                    <hr class="mt-3">
                    <!-- Show Current Inventory -->
                    <div class="col-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Item Id</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Remaining Stock</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="inventory">
                                <!-- Inventory will be shown here -->
                                
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>