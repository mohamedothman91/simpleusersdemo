<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">My Dashboard</li>
		</ol>
		<!-- Icon Cards-->
		<div class="row">
			<script src="https://kendo.cdn.telerik.com/2017.3.913/js/kendo.all.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser-polyfill.min.js"></script>
			<script src="https://unpkg.com/vue/dist/vue.min.js"></script>

			<!--Load the required Kendo Vue package(s)-->
			<script src="https://unpkg.com/@progress/kendo-grid-vue-wrapper/dist/cdn/kendo-grid-vue-wrapper.min.js"></script>

			<div id="vueapp" class="vue-app">
				<kendo-grid :data-source="localDataSource" :sortable='true' :pageable='true' :groupable='true'>
				</kendo-grid>
			</div>

			<script>
				new Vue({
					el: '#vueapp',
					methods: {
						onDataBinding: function(ev) {
							console.log("Grid is about to be bound!");
						},
						onDataBound: function(ev) {
							console.log("Grid is now bound!");
						}
					},
					data: {
						localDataSource: <?= json_encode($users) ?>
					}
				})
			</script>
		</div>
	</div>
</div>