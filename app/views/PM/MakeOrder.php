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
    <script src="./static/js/initInventory.js" defer></script>
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

                <!-- breadcrumb -->
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item"><a href="MakeOrder">Make Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Select Target Restaurant</li>
                        </ol>
                    </nav>
                </div>
                <hr class="mt-0">

                <!--  -->
                <div class="row">
                    <a2 class="h4 mb-3">Select Target Restaurant</a2>
                    <!-- Select Target Restaurant -->
                    <div class="col-4">
                        <label for="restaurant" class="form-label">Restaurant</label>
                        <select class="form-select" onchange="loadInventory(this.value)" name="restaurant" id="restaurant" aria-label="Select Target Restaurant">
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
                </div>

                <!-- Show Inventory Button -->
                <div class="row">
                    <div class="mt-4 d-flex align-items-end justify-content-end">
                        <button class="btn btn-primary" id="confirmRestaurant">Confirm Target Restaurant</button>
                    </div>
                </div>
                <hr class="mt-3 mb-1">
                <!-- Show Current Inventory -->
                <div class="row p-3 table-responsive" id="inventoryTable">
                    <a2 class="h4 col">Current Inventory</a2>
                    <div class="dropdown d-flex align-items-end justify-content-end col-4">
                        <select class="form-select" onchange="updateInventoryDisplay(this.value)" name="category-list" id="category-list" aria-label="All Categories">
                            <option value="all" selected>All Categories</option>
                            <option value="Vegetables">Vegetables</option>
                            <option value="Seafoods">Seafoods</option>
                        </select>
                    </div>
                    <table class="table table-striped table-hover mt-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th><!-- virtual id -->
                                <th scope="col">Item Name</th>
                                <th scope="col">Reference Img</th>
                                <th scope="col">Specifications</th>
                                <th scope="col">Remaining Stock</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="inventory">
                            <!-- Inventory will be shown here -->
                            <tr>
                                <td colspan="7" class="text-center">Select a restaurant to view inventory</td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>

</body>

</html>