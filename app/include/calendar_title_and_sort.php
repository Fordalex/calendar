<?php include_once '../app/database/read/get_all_categories.php'; ?>

<div class="col-12 pt-4 px-0 mb-5 header">
    <h1 class="text-center mb-0">
        <?php echo $_SESSION['year']; ?>
    </h1>
    <h6 class="text-secondary text-center"><?php echo $_SESSION['filterCategories'] ?></h6>
    <hr class="mb-0">
    <form action="../app/database/read/filter_categories.php" method="GET" class="container-fluid p-0">
        <div class="row m-0 p-0">
            <div class="col-6 col-md-4 col-lg-2">
                <label class="mt-2"><b>Category</b></label>

                <select class="form-control" name="category">

                    <option value="All">All</option>
                    <?php
                    foreach ($categories as $category) {
                        $categoryName = $category['category'];
                        echo "<option>$categoryName</option>";
                    }
                    ?>
                </select>

            </div>
            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-end p-0">
                <button type="submit" class="btn btn-dark">Filter</button>
            </div>
        </div>
    </form>
    <hr class="mb-0">
</div>