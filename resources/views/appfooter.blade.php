<footer class="footer border-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="copyright">All Rights Reserved | &copy; {{ config("app.name") }} - {{ date('Y') }}</div>
			</div>
			<div class="col">
				<div class="footer-links text-right">
					<a href="{{ url('info/about') }}">About us</a> | 
					<a href="{{ url('info/faq') }}">Help and FAQ</a> |
					<a href="{{ url('info/contact') }}">Contact us</a>  |
					<a href="{{ url('info/privacypolicy') }}">Privacy Policy</a> |
					<a href="{{ url('info/termsandconditions') }}">Terms and Conditions</a>
				</div>
			</div>
			
		</div>
	</div>
</footer>