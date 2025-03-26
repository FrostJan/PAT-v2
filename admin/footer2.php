<!-- jQuery 3 -->
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<script src="../bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script src="assets/js/fontawesome.js"></script>



<script>

	setInterval(function(){
	$.ajax({
		url: '../data/messages_count.php',
		type: 'POST',
		cache: false,
		success: function(data){
			$('.messages_count').html(data)
		}
	})
	$.ajax({
		url: '../data/customers_info_count.php',
		type: 'POST',
		cache: false,
		success: function(data){
			$('.customers_info_count').html(data)
		}
	})
	},1000)

	$('.shownotif').click(function(){
		$('.cardnotif').toggleClass('cardnotif_show')
	})
	
	const currencyEl_one = document.getElementById('currency-one');
	const amountEl_one = document.getElementById('amount-one');
	const currencyEl_two = document.getElementById('currency-two');
	const amountEl_two = document.getElementById('amount-two');

	const rateEl = document.getElementById('rate');
	const swap = document.getElementById('swap');

	// Fetch exchange rates and update the DOM
	function calculate() {
	  const currency_one = currencyEl_one.value;
	  const currency_two = currencyEl_two.value;

	  fetch(`https://api.exchangerate-api.com/v4/latest/${currency_one}`)
	    .then(res => res.json())
	    .then(data => {
	      // console.log(data);
	      const rate = data.rates[currency_two];
	      
	      rateEl.innerText = `1 ${currency_one} = ${rate} ${currency_two}`;

	      amountEl_two.value = (amountEl_one.value * rate).toFixed(2)
	    })

	}

	// Event listeners
	currencyEl_one.addEventListener('change', calculate);
	amountEl_one.addEventListener('input', calculate);
	currencyEl_two.addEventListener('change', calculate);
	amountEl_two.addEventListener('input', calculate);

	swap.addEventListener('click', ()=> {
	  const temp = currencyEl_one.value;
	  currencyEl_one.value = currencyEl_two.value;
	  currencyEl_two.value = temp;
	  calculate()
	})

	calculate()


</script>
