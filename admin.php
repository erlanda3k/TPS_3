<?php
include('function.php');
include('session.php'); 
$result=mysqli_query($conn, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kelola Admin - Bagian Umum</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php"> <img src="<?=('assets/logo.png'); ?>" width="70px" height="55px">Bagian Umum</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inventory Barang</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                                
                            </a>
                           
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Laporan Data Barang
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="masuk.php">Barang Masuk</a>
                                            <a class="nav-link" href="keluar.php">Barang Keluar</a>
                                            <a class="nav-link" href="request.php">Request Barang</a>
                                        </nav>
                                    </div>                                    
                                    
                        </div>
                        <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola Admin
                            </a>
                        	
                    </div>
                </nav>

            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola Admin</h1>

                      <div class="card-mb-4">
                      	<div class=" card-header"> 
                        <!-- Button to Open the Modal -->
					  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					    Tambah Admin
					  </button>
					  
                      </div>  
                            <div class="card-body">
                            	<div class="table-responsive">
                                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username Admin</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    	<?php
                                    	$no = 0;
                                    	$ambilsemuadataadmin = mysqli_query($conn,"SELECT * FROM users");
                                    	
                                    	while($data=mysqli_fetch_array($ambilsemuadataadmin)){
                                    		$no++;
                                    		$us = $data['username'];
                                            $user_id = $data['user_id'];
                                            $pw = $data['password'];
                                    	?>

                                        <tr>
                                            <td><?=$no;?></td>
                                            <td><?=$us;?></td>
                                            
                                            <td>
                                            	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$user_id;?>">
												    Edit
												 </button>
												 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$user_id;?>">
												    Delete
												 </button>
                                            </td>
                                            
                                        </tr>
                                        <!-- Edit Modal -->	
                                        <div class="modal fade" id="edit<?=$user_id;?>"> 
                                        	<div class="modal-dialog">
                                        	<div class="modal-content">
		                               <!-- Modal Header -->
								        <div class="modal-header">
								          <h4 class="modal-title">Edit Admin</h4>
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								        </div>
								        
								        <!-- Modal body -->
								        <form method="post">
								        <div class="modal-body">
								          <input type="username" name="usernameadmin" value="<?=$us;?>" class="form-control" placeholder="username" required>
								          <br>
								          <input type="password" name="passwordbaru" class="form-control" value="<?=$pw;?>" placeholder="password">
								          <br>
								          <input type="hidden" name="id" value="<?=$user_id;?>">
								          <button type="submit" class="btn btn-primary" name="updateadmin"> Submit </button>
								        </div>
								        </form>
								        </div>
									    </div>
									  </div>

									  <!-- Delete Modal -->	
                                        <div class="modal fade" id="delete<?=$user_id;?>"> 
                                        	<div class="modal-dialog">
                                        	<div class="modal-content">
		                               <!-- Modal Header -->
								        <div class="modal-header">
								          <h4 class="modal-title">Hapus Admin</h4>
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								        </div>
								        
								        <!-- Modal body -->
								        <form method="post">
								        <div class="modal-body">
								         Apakah Anda yakin ingin menghapus <?=$us;?>?
								         <input type="hidden" name="id" value="<?=$user_id;?>">
								          <br>
								          <br>
								          <button type="submit" class="btn btn-danger" name="hapusadmin"> Submit </button>
								        </div>
								        </form>
								        </div>
									    </div>
									  </div>
                                        <?php
                                    	};

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                
                </div>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright ; Erlanda Kurniawan (19510008)</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
	    <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
          <input type="username" name="username" placeholder="Username" class="form-control" required>
          <br>
          <input type="password" name="password" placeholder="Password" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addadmin"> Submit </button>
        </div>
        </form>

        
        
      </div>
    </div>
  </div>
  
</html>
