<!DOCTYPE html>
<html lang="en">    
    @include('body.header')
    @include('body.script')
    <body class="hold-transition sidebar-mini dark-mode">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Include the navbar and the sidebar here -->
        @include('body.navbar')
        @include('body.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- Include the footer here -->
        @include('body.footer')
    </div>
    
    </body>
	<script src="{{asset('backend/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$(document).on('click', '#delete', function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				Swal.fire({
					title: 'Are you sure do you want to delete this?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = link
					}
					})
			});
		});
	</script>
	<script type="text/javascript">
		$(function(){
			$(document).on('click', '#terminate', function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				Swal.fire({
					title: 'Are you sure do you want to terminate this saving?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, terminate it!'
					}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = link
					}
					})
			});
		});
	</script>
	<script type="text/javascript" src="{{asset('backend/js/toastr.js')}}"></script>
	<script>
	@if(Session::has('message'))
	var type = "{{ Session::get('alert-type','info') }}"
	switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;

		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;

		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;

		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break; 
	}
	@endif 
	</script>
	

</html>