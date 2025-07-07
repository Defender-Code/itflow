<?php

// Default Column Sortby Filter
$sort = "client_name";
$order = "ASC";

require_once "includes/inc_all_admin.php";

$sql = mysqli_query($mysqli, "SELECT * FROM client_saved_payment_methods 
    LEFT JOIN payment_providers ON saved_payment_provider_id = payment_provider_id
    LEFT JOIN clients ON saved_payment_client_id = client_id
    WHERE (client_name LIKE '%$q%' OR payment_provider_name LIKE '%$q%' OR saved_payment_details LIKE '%$q%' OR saved_payment_provider_client LIKE '%$q%' OR saved_payment_provider_method LIKE '%$q%')
    ORDER BY $sort $order"
);

$num_rows = mysqli_num_rows($sql);

?>

<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-fw fa-credit-card mr-2"></i>Saved Payment Methods</h3>
    </div>
    <div class="card-body">
        <form class="mb-4" autocomplete="off">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="search" class="form-control" name="q" value="<?php if (isset($q)) {echo stripslashes(nullable_htmlentities($q));} ?>" placeholder="Search Saved Payment Methods">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive-sm">
            <table class="table table-striped table-borderless table-hover">
                <thead class="text-dark <?php if ($num_rows == 0) { echo "d-none"; } ?>">
                <tr>
                    <th>
                        <a class="text-dark" href="?<?php echo $url_query_strings_sort; ?>&sort=client_name&order=<?php echo $disp; ?>">
                            Client <?php if ($sort == 'client_name') { echo $order_icon; } ?>
                        </a>
                    </th>
                    <th>
                        <a class="text-dark" href="?<?php echo $url_query_strings_sort; ?>&sort=payment_provider_name&order=<?php echo $disp; ?>">
                            Provider <?php if ($sort == 'payment_provider_name') { echo $order_icon; } ?>
                        </a>
                    </th>
                    <th>
                        <a class="text-dark" href="?<?php echo $url_query_strings_sort; ?>&sort=saved_payment_details&order=<?php echo $disp; ?>">
                            Details <?php if ($sort == 'saved_payment_details') { echo $order_icon; } ?>
                        </a>
                    </th>
                    <th>
                        <a class="text-dark" href="?<?php echo $url_query_strings_sort; ?>&sort=saved_payment_provider_client&order=<?php echo $disp; ?>">
                            Provider Client ID <?php if ($sort == 'saved_payment_provider_client') { echo $order_icon; } ?>
                        </a>
                    </th>
                    <th>
                        <a class="text-dark" href="?<?php echo $url_query_strings_sort; ?>&sort=saved_payment_provider_method&order=<?php echo $disp; ?>">
                            Provider Payment Method ID <?php if ($sort == 'saved_payment_provider_method') { echo $order_icon; } ?>
                        </a>
                    </th>
                    <th>
                        <a class="text-dark" href="?<?php echo $url_query_strings_sort; ?>&sort=saved_payment_created_at&order=<?php echo $disp; ?>">
                            Created <?php if ($sort == 'saved_payment_created_at') { echo $order_icon; } ?>
                        </a>
                    </th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                while ($row = mysqli_fetch_array($sql)) {
                    $saved_payment_id = intval($row['saved_payment_id']);
                    $client_id = intval($row['client_id']);
                    $client_name = nullable_htmlentities($row['client_name']);
                    $provider_id = intval($row['payment_provider_id']);
                    $provider_name = nullable_htmlentities($row['payment_provider_name']);
                    $saved_payment_details = nullable_htmlentities($row['saved_payment_details']);
                    $provider_client = nullable_htmlentities($row['saved_payment_provider_client']);
                    $provider_payment_method = floatval($row['saved_payment_provider_method']);
                    $saved_payment_created_at = nullable_htmlentities($row['saved_payment_created_at']);

                    ?>
                    <tr>
                        <td><?php echo $client_name; ?> (<?php echo $client_id; ?>)</td>
                        <td><?php echo $provider_name; ?> (<?php echo $provider_id; ?>)</td>
                        <td><?php echo $saved_payment_details; ?></td>
                        <td><?php echo $provider_client; ?></td>
                        <td><?php echo $provider_payment_method; ?></td>
                        <td><?php echo $saved_payment_created_at; ?></td>
                        <td>
                            <a class="btn btn-outline-danger confirm-link" href="post.php?delete_saved_payment=<?php echo $saved_payment_id; ?>&csrf_token=<?php echo $_SESSION['csrf_token'] ?>">
                                <i class="fas fa-fw fa-trash mr-2"></i>Delete
                            </a>
                        </td>
                    </tr>

                    <?php

                }

                if ($num_rows == 0) {
                    echo "<h3 class='text-secondary mt-3' style='text-align: center'>No Records Here</h3>";
                }

                ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<?php
require_once "includes/footer.php";
