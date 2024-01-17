<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="/assets_admin/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="/assets_admin/js/jquery.min.js"></script>
	<script src="/assets_admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets_admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets_admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="/assets_admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets_admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/assets_admin/plugins/chartjs/js/Chart.min.js"></script>
	<script src="/assets_admin/plugins/chartjs/js/Chart.extension.js"></script>
	<script src="/assets_admin/js/index.js"></script>
	<!--app JS-->
	<script src="/assets_admin/plugins/select2/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
	<script src="/assets_admin/js/app.js"></script>


