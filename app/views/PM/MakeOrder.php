<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <!-- 此<base>標籤設定文件中所有相對 URL 的基本 URL。這意味著，如果將其設為“/”，則所有相對 URL 都將從網域的根解析 -->
    <!-- <base href="../" /> -->
    <script src="./static/js/virtualItems/itemOperations.js" defer></script>
    <?php
    require_once './static/components/head.php';
    require_once './static/components/pm/sidebar.php';
    require_once './static/components/header.php';
    ?>
    <script src="./static/js/initInventory.js" defer></script>
    <script src="./static/js/orderWorkflow.js"></script>
    
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
                            <li class="breadcrumb-item active" aria-current="page">Step 1: Select Target Restaurant</li>
                        </ol>
                    </nav>
                </div>
                <hr class="mt-0">

                <!--  -->
                <div class="card" id="target-restaurant-area">
                    <div class="card-header">
                        Select Target Restaurant
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="target-restaurant" class="form-label">Restaurant</label>
                                <select class="form-select" onchange="loadInventory(this.value)" name="target-restaurant" id="target-restaurant" aria-label="Select Target Restaurant">
                                    <option value="" selected>Select Target Restaurant</option>
                                    <?php
                                    foreach ($viewData as $restaurant): ?>
                                        <option value="<?= htmlspecialchars($restaurant->getId()) ?>"
                                            data-type="<?= htmlspecialchars($restaurant->getType()) ?>"
                                            data-address="<?= htmlspecialchars($restaurant->getAddress()) ?>"
                                            data-name="<?= htmlspecialchars($restaurant->getRestaurantName()) ?>">
                                            <?= htmlspecialchars($restaurant->getRestaurantName()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" readonly>
                            </div>
                            <div class="col-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" readonly>
                            </div>
                        </div>
                        <!-- Show Inventory Button -->
                        <div class="row" id="target-restaurant-area-btn">
                            <div class="mt-4 d-flex align-items-end justify-content-end">
                                <button class="btn btn-primary" id="confirmRestaurant" onClick="confirmTargetRestaurant()">Confirm Target Restaurant</button>
                            </div>
                        </div>
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
                    <table class="table table-striped table-hover mt-3 table-bordered">
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