<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Users</li>
		</ol>
		<!-- Icon Cards-->
		<div class="row">
			<script src="http://kendo.cdn.telerik.com/2018.2.516/js/kendo.all.min.js"></script>
			<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2018.2.516/styles/kendo.common.min.css" />
			<table id="grid">
				<thead>
					<tr>
						<th  data-field="id">id</th>
						<th  data-field="name">name</th>
						<th  data-field="email">email</th>
						<th  data-field="company">company</th>
						<th  data-field="title">title</th>
						<th  data-field="address">address</th>
						<th  data-field="city">city</th>
						<th  data-field="phone">phone</th>
						<th   data-field="action">action</th>
					</tr>
				</thead>
				<tbody>
					
						<?php 
                        if ($users) {
                            foreach ($users as $key => $value) {
                                ?>
							<tr>
								<td><?= $value['id']; ?></td>
								<td><?= $value['first_name'].' '.$value['last_name']; ?></td>
								<td><?= $value['email']; ?></td>
								<td><?= $value['company']; ?></td>
								<td><?= $value['title']; ?></td>
								<td><?= $value['address']; ?></td>
								<td><?= $value['city']; ?></td>
								<td><?= $value['phone']; ?></td>
								<td>
									<a class='btn btn-info btn-sm' href='<?= base_url(); ?>users/edit/<?= $value['id']; ?>'>Edit</a>
									<a class='btn btn-danger btn-sm' href='<?= base_url(); ?>users/delete/<?= $value['id']; ?>'>delete</a>
								</td>
							</tr>
							<?php
                            }
                        }
                        ?>
					
				
				</tbody>
			</table>
		<script>
			  $(document).ready(function(){
				$("#grid").kendoGrid({
					dataSource: {
						pageSize: 20
					},
					sortable: true,
					filterable: true,
					 height: 500,
					 pageable: {
						messages: {
							display: "{0} - {1} of {2} items", //{0} is the index of the first record on the page, {1} - index of the last record on the page, {2} is the total amount of records
							empty: "No items to display",
							page: "Page",
							allPages: "All",
							of: "of {0}", //{0} is total amount of pages
							itemsPerPage: "items per page",
							first: "Go to the first page",
							previous: "Go to the previous page",
							next: "Go to the next page",
							last: "Go to the last page",
							refresh: "Refresh"
						}
					}
				});
				});

		</script>
		</div>	
	</div>
</div>