<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="adminpanel.php">Phambili Agencies CC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="adminpanel.php">Admin Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminOrdersActive.php">Orders Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminOrdersHistory.php">Order History</a>
                </li>
                <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Welcome <?php echo $_SESSION['username'] ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>