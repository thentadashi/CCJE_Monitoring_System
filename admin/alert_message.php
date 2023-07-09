<?php
if (isset($_SESSION['successmessage'])) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?php echo $_SESSION['successmessage']; ?></strong>
        <button type="button" class="btn-close btn-sm" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    unset($_SESSION['successmessage']);
}
?>
<?php
if (isset($_SESSION['errormessage'])) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> <?php echo $_SESSION['errormessage']; ?>
        <button type="button" class="btn-close btn-sm" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    unset($_SESSION['errormessage']);
}
?>