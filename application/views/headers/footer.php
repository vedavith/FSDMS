<footer class = "footer-fixed fixed-bottom" style="background:#343A40">
			<div class = "container-fluid">
				<div class ="row">
					<div class = "col">
						<div align = "left">
							 <p style="color: #fff;margin-top: 18px;"> <?php echo date("Y");?> </p>
						</div>
					</div>
					<div class = "col">
						<div align = "right">

							<a href="http://zenopsys.com/"><img src="https://2.bp.blogspot.com/-WiMKgntZCHs/V8vA9XDjKpI/AAAAAAAAGV4/BesnMsluiBQrGFuELzKHJzoQ-nB9sW4wACLcB/s1600/Zenopsys-Technologies.png" width="90" height="60" ></a>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script type="text/javascript">
			// Hide submenus
// Hide submenus
$('#body-row .collapse').collapse('hide');

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    $('#sidebar-container').addClass('sticky-top sticky-offset');

    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }

    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
		</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"> -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<!-- Latest compiled and minified Locales -->
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- <script src="http://airizen.com/armyprj/assets/vue.js"></script> -->
</body>
</html>
