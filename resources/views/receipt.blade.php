<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{url('/css/static-site/bootstrap.min.css')}}" />
	<title></title>
	<style type="text/css">
		.receipt-content .logo a:hover {
  text-decoration: none;
  color: #7793C4;
}

.receipt-content .invoice-wrapper {
  /*background: #FFF;*/
  /*border: 1px solid #CDD3E2;
  box-shadow: 0px 0px 1px #CCC;
  padding: 40px 40px 60px;
  margin-top: 40px;
  border-radius: 4px; */
}

.receipt-content .invoice-wrapper .payment-details span {
  color: #A9B0BB;
  display: block;
}
.receipt-content .invoice-wrapper .payment-details a {
  display: inline-block;
  margin-top: 5px;
}

.receipt-content .invoice-wrapper .line-items .print a {
  display: inline-block;
  border: 1px solid #9CB5D6;
  padding: 13px 13px;
  border-radius: 5px;
  color: #708DC0;
  font-size: 13px;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear;
}

.receipt-content .invoice-wrapper .line-items .print a:hover {
  text-decoration: none;
  border-color: #333;
  color: #333;
}

.receipt-content {
  background: #ECEEF4;
}
@media (min-width: 1200px) {
  .receipt-content .container {width: 900px; }
}

.receipt-content .logo {
  text-align: center;
  margin-top: 50px;
}

.receipt-content .logo a {
  font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
  font-size: 36px;
  letter-spacing: .1px;
  color: #555;
  font-weight: 300;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear;
}

.receipt-content .invoice-wrapper .intro {
  line-height: 25px;
  color: #444;
  text-transform: uppercase;
}

.receipt-content .invoice-wrapper .payment-info {
  margin-top: 25px;
  padding-top: 15px;
}

.receipt-content .invoice-wrapper .payment-info span {
  color: #A9B0BB;
}

.receipt-content .invoice-wrapper .payment-info strong {
  display: block;
  color: #444;
  margin-top: 3px;
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-info .text-right {
  text-align: left;
  margin-top: 20px; }
}
.receipt-content .invoice-wrapper .payment-details {
  border-top: 2px solid #EBECEE;
  margin-top: 30px;
  padding-top: 20px;
  line-height: 22px;
}


@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-details .text-right {
  text-align: left;
  margin-top: 20px; }
}
.receipt-content .invoice-wrapper .line-items {
  margin-top: 40px;
}
.receipt-content .invoice-wrapper .line-items .headers {
  color: #A9B0BB;
  font-size: 13px;
  letter-spacing: .3px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 4px;
}
.receipt-content .invoice-wrapper .line-items .items {
  margin-top: 8px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 8px;
}
.receipt-content .invoice-wrapper .line-items .items .item {
  padding: 10px 0;
  color: #696969;
  font-size: 15px;
}
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item {
  font-size: 13px; }
}
.receipt-content .invoice-wrapper .line-items .items .item .amount {
  letter-spacing: 0.1px;
  color: #84868A;
  font-size: 16px;
 }
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item .amount {
  font-size: 13px; }
}

.receipt-content .invoice-wrapper .line-items .total {
  margin-top: 30px;
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes {
  float: left;
  width: 40%;
  text-align: left;
  font-size: 13px;
  color: #7A7A7A;
  line-height: 20px;
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .total .extra-notes {
  width: 100%;
  margin-bottom: 30px;
  float: none; }
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
  display: block;
  margin-bottom: 5px;
  color: #454545;
}

.receipt-content .invoice-wrapper .line-items .total .field {
  margin-bottom: 7px;
  font-size: 14px;
  color: #555;
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total {
  margin-top: 10px;
  font-size: 16px;
  font-weight: 500;
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
  color: #20A720;
  font-size: 16px;
}

.receipt-content .invoice-wrapper .line-items .total .field span {
  display: inline-block;
  margin-left: 20px;
  min-width: 85px;
  color: #84868A;
  font-size: 15px;
}

.receipt-content .invoice-wrapper .line-items .print {
  margin-top: 50px;
  text-align: center;
}



.receipt-content .invoice-wrapper .line-items .print a i {
  margin-right: 3px;
  font-size: 14px;
}

.receipt-content .footer {
  margin-top: 10px;
  margin-bottom: 110px;
  text-align: center;
  font-size: 12px;
  color: #969CAD;
}

.table td {
	padding-top: 0;
	padding-bottom: 0;
}

	</style>
</head>
<body >

<div class="receipt-content" style="background-color:white;">
    <div class="container bootstrap snippets bootdey">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">

					<header class="text-center mt-4 mb-4">
						<h3>Mankind Medicare</h3>
					</header>

					<div class="intro">
						<strong>Receipt</strong>
					</div>

					<div class="payment-info">
						<div class="row">
							<div class="col-sm-10">
								<table class="table table-borderless text-muted">
									<tbody>
										<tr>
											<td class="text-uppercase">Reference no</td>
											<td>:</td>
											<td>{{$appointment->reference_no ?? ''}}</td>
										</tr>

										<tr>
											<td>&nbsp;</td>
										</tr>

										<tr>
											<td class="text-uppercase">Appointment date</td>
											<td>:</td>
											<td><strong>{{\Carbon\Carbon::parse($appointment->session_datetimestamp)->format('d/m/Y')}}</strong></td>
										</tr>


										<tr>
											<td class="text-uppercase">Appointment Time</td>
											<td>:</td>
											<td><strong>{{$appointment_time}} </strong> <small>(Time may vary according to doctor's arrival time)</small></td>
										</tr>

										<tr>
											<td class="text-uppercase">Appointment no</td>
											<td>:</td>
											<td><strong>{{$appointment_no}}</strong></td>
										</tr>

										<tr>
											<td class="text-uppercase">Clinic</td>
											<td>:</td>
											<td>{{$appointment->viewDoctor->clinic->name}}</td>
										</tr>

										<tr>
											<td>&nbsp;</td>
										</tr>

										<tr>
											<td class="text-uppercase">Patient's Name</td>
											<td>:</td>
											<td>{{$appointment->display_name}}</td>
										</tr>

										<tr>
											<td class="text-uppercase">Phone number</td>
											<td>:</td>
											<td><a href="tel:{{$appointment->ph_no}}" style="color: blue;">{{$appointment->ph_no}}</a></td>
										</tr>

										<tr>
											<td class="text-uppercase">Email</td>
											<td>:</td>
											<td><a href="mailto:{{$appointment->email_address}}" style="color: blue;">{{$appointment->email_address}}</a></td>
										</tr>

										<tr>
											<td>&nbsp;</td>
										</tr>

										<tr>
											<td class="text-uppercase">Doctor Name</td>
											<td>:</td>
											<td><strong>{{$appointment->viewDoctor->saluation}} {{$appointment->viewDoctor->user->first_name}} {{$appointment->viewDoctor->user->last_name}} <small>({{$appointment->viewDoctor->viewSpeciality->speciality}})</small></strong></td>
										</tr>

										<tr>
											<td>&nbsp;</td>
										</tr>

										<tr>
											<td class="text-uppercase">Hospital Address:</td>
											<td>:</td>
											<td>{{ $appointment->viewDoctor->clinic->address['number'] }}, {{ $appointment->viewDoctor->clinic->address['street_line_1'] }}{{ $appointment->viewDoctor->clinic->address['street_line_2'] ==! null ? ', ' . $appointment->viewDoctor->clinic->address['street_line_2'] . ',' : '' }} {{$appointment->viewDoctor->clinic->address['city'] }}</td>
										</tr>

										<tr>
											<td class="text-uppercase">Hospital Contact number:</td>
											<td>:</td>
											<td>
												@foreach($appointment->viewDoctor->clinic->contact_nos as $contact_no)
												<a href="tel:{{$contact_no}}" style="color: blue;">
													{{$contact_no}}
												</a>

													@if ($loop->last)

											    @else
											    /
											    @endif
												@endforeach
											</td>
										</tr>

										<tr>
											<td class="text-uppercase">Hospital Email:</td>
											<td>:</td>
											<td>
												<a href="tel:{{$appointment->viewDoctor->clinic->email}}" style="color: blue;">
													{{$appointment->viewDoctor->clinic->email}}
												</a>
											</td>
										</tr>

										@isset($appointment->viewDoctor->clinic->url)
										<tr>
											<td class="text-uppercase">Hospital Website:</td>
											<td>:</td>
											<td>
												<a href="{{$appointment->viewDoctor->clinic->url}}" style="color: blue;">
													{{$appointment->viewDoctor->clinic->url}}
												</a>
											</td>
										</tr>
										@endisset

									</tbody>
								</table>
								<p class="text-uppercase">
									<b>Terms and Conditions</b><br>
								</p>
								<p>
									Please refer <a href="{{route('terms.show')}}" style="color: blue;">{{route('terms.show')}}</a>
								</p>

							</div>
						</div>
					</div>

				</div>

				<div class="footer">
					Copyright © {{date('Y')}}. Mankind Medicare
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
