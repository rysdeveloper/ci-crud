<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Management - CI CRUD</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		body {
			background-color: #f8f9fa;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
		.navbar {
			box-shadow: 0 2px 4px rgba(0,0,0,.1);
		}
		.navbar-brand {
			font-weight: 700;
			font-size: 1.5rem;
		}
		.page-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 2rem 0;
			margin-bottom: 2rem;
			border-radius: 0 0 10px 10px;
		}
		.page-header h1 {
			margin: 0;
			font-weight: 700;
		}
		.card {
			border: none;
			box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
			margin-bottom: 1.5rem;
		}
		.table {
			background-color: white;
		}
		.table thead th {
			border-bottom: 2px solid #dee2e6;
			font-weight: 600;
			background-color: #f8f9fa;
		}
		.btn-group-sm {
			gap: 0.25rem;
		}
		.alert {
			border-radius: 8px;
			border: none;
		}
		.container {
			max-width: 1200px;
		}
		main {
			min-height: calc(100vh - 200px);
			padding: 2rem 0;
		}
		footer {
			background-color: #343a40;
			color: white;
			padding: 2rem 0;
			margin-top: 3rem;
			text-align: center;
		}
	</style>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="/products">
				<i class="fas fa-box"></i> Product Management
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="/products">Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/products/create">Add Product</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Main Content -->
	<main>
		<div class="container">
			<?= $this->renderSection('content') ?>
		</div>
	</main>

	<!-- Footer -->
	<footer>
		<div class="container">
			<p class="mb-0">&copy; 2024 Product Management System. All rights reserved.</p>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>