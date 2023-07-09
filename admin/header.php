<!DOCTYPE html>
<html lang="en">

<head>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
         <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">E-CRIMS MANAGEMENT  </a>
       
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary btn-sm" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <a class="btn btn-primary btn-sm" href="../index.php" role="button" data-toggle="modal" data-target="#exitModal"><i class="bi bi-box-arrow-right"></i> Log out</a>
        </ul>
    </nav>
</body>
<!-- Modal -->
<div class="modal fade" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header bg-warning">
                <h5 class="modal-title " id="exampleModalLabel"><i class="bi bi-exclamation-triangle-fill"></i> Log out</h5>
                <button type="button" class="btn-close btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p class="text-center"> Are you certain you want to leave?</p>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <a type="button" href="../index.php" class="btn btn-primary btn-sm">Yes</a>
            </div>
        </div>
    </div>
</div>
<script>
    // Add your custom JavaScript code here

    // Sidebar Toggle Functionality
    document.getElementById('sidebarToggle').addEventListener('click', function() {
      document.body.classList.toggle('sb-sidenav-toggled');
    });
  </script>
</html>