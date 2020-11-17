<div class="col-12 p-0">
    <h4><?php echo $_SESSION['date'];?></h4>
    <h6 class="text-secondary" id="occasion"></h6>
    <?php
        if ($customChores->num_rows > 0) {
            echo "<button href='#addForm' data-toggle='collapse' class='btn btn-dark float-right mb-2'>Add</button>";   
        } else {
            echo "<a href='add_custom_chore.php' class='btn btn-warning container-fluid mb-3'>Create Chores</a>";
        }
    ?>
    
</div>
<div class="col-12 m-0 p-0">
    <div id="addForm" class="collapse">
        <form action="forms/add_date_data.php?redirect=view_yearly" method="POST">
            <select class="form-control mt-2" name="choreId">
                <?php
                    foreach ($customChores as $customChore) {
                        $customChoreChore = $customChore['chore'];
                        $customChoreId = $customChore['id'];
                        echo "<option value='$customChoreId'>$customChoreChore</option>";
                    }
                ?>
            </select>
            <button class="btn btn-success my-3 container-fluid" type="submit">Submit</button>
        </form>
    </div>
</div>