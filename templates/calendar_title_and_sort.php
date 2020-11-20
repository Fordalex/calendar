<?php include_once 'database/get_all_categories.php'; ?>

<div class="col-12 pt-4 px-0 header">
    <h1 class="text-center mb-0">
        <?php echo $_SESSION['year']; ?>
    </h1>
    <h6 class="text-secondary text-center">All Categories</h6>
    <hr class="mb-0">
    <div class="row m-0 p-0">
        <div class="col-8 col-md-4 col-lg-2">
            <label class="mt-2"><b>Category</b></label>
            <select class="form-control">
                <option value="All">All</option>
                <?php
                    foreach ($categories as $category) {
                        $categoryName = $category['category'];
                        echo "<option>$categoryName</option>";
                    }
                ?>
            </select>
        </div>
    </div>

    <hr class="mb-0">
</div>