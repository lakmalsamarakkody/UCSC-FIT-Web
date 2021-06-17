@extends('layouts.student_portal')

@section('content')

	<script type="text/javascript">
		// ACTIVE NAVIGATION ENTRY
		$(document).ready(function ($) {
				$('#home').addClass("active");
		});
	</script>

	@if($student)

		<!-- CONTENT -->
		<div class="col-lg-12 dashboard">
			<div class="row justify-content-center">
				@if($student->current_active_registration() == NULL && ($student->last_registration() == NULL || $student->processing_registration()))

						<!-- APPLICATION STATUS -->
						@if($registration->application_submit)
							<div class="col-lg-4 w-100">
								<div class="card card-dash shadow red-none @if($registration->application_status == null) yellow @elseif($registration->application_status == 'Approved') green @else red @endif" style="">

									<div class="card-header bg-transparent text-white"><h1>Application <br> Status</h1></div>
									<div class="card-body p-0 my-0 ">
									<div class="card-title text-right ">
										<span class="badge shadow badge-pill @if($registration->application_status == null) badge-warning @elseif($registration->application_status == 'Approved') badge-success @else 'badge-danger' @endif  mr-3">{{ $registration->application_status ?? 'Pending' }}</span></div>
									</div>
								</div>
							</div>
						@else
							<div class="col-lg-4 w-100">
									<a class="" href="{{ route('student.registration') }}">
											<div class="card card-dash shadow red-none bg-danger" style="">

													<div class="card-header bg-transparent text-center text-white p-0 py-5"><h3>Submit Application</h1></div>
													<div class="card-body p-0 my-0 ">
													</div>
											</div>
									</a>
							</div>
						@endif

						{{-- PAYMENT STATUS --}}
						@if($registration->payment_id )
							<div class="col-lg-4 w-100">
								<div class="card card-dash shadow red-none @if($registration->payment_status == null) yellow @elseif($registration->payment_status == 'Approved') green @else red @endif" style="">
									<div class="card-header bg-transparent text-white"><h1>Payments <br> Status</h1></div>
									<div class="card-body p-0 my-0 ">
										<div class="card-title text-right "><span class="badge shadow badge-pill @if($registration->payment_status == null) badge-warning @elseif($registration->payment_status == 'Approved') badge-success @else 'badge-danger' @endif  mr-3">{{ $registration->payment_status ?? 'Pending' }}</span></div>
									</div>
								</div>
							</div>
						@else
							<div class="col-lg-4 w-100">
								<a class="" href="{{ route('student.registration') }}">
									<div class="card card-dash shadow red-none bg-danger" style="">
										<div class="card-header bg-transparent text-center text-white p-0 py-5"><h3>Complete  your Payment</h1></div>
										<div class="card-body p-0 my-0 ">
										</div>
									</div>
								</a>
							</div>
						@endif

						{{-- DOCUMENT STATUS --}}
						@if($registration->document_submit )
							<div class="col-lg-4 w-100">
								<div class="card card-dash shadow red-none @if($registration->document_status == null) yellow @elseif($registration->document_status == 'Approved') green @else red @endif" style="">
									<div class="card-header bg-transparent text-white"><h1>Document <br> Status</h1></div>
									<div class="card-body p-0 my-0 ">
									<div class="card-title text-right ">
										<span class="badge shadow badge-pill @if($registration->document_status == null) badge-warning @elseif($registration->document_status == 'Approved') badge-success @else 'badge-danger' @endif  mr-3">{{ $registration->document_status ?? 'Pending' }}</span></div>
									</div>
								</div>
							</div>
						@else
							<div class="col-lg-4 w-100">
								<a class="" href="{{ route('student.registration') }}">
									<div class="card card-dash shadow red-none bg-danger" style="">
										<div class="card-header bg-transparent text-center text-white p-0 py-5"><h3>Submit Documents</h1></div>
										<div class="card-body p-0 my-0 "></div>
									</div>
								</a>
							</div>
							{{-- REGISTRATION  PENDING --}}
							<div class="col-12 mt-2">
								<div class="alert alert-danger shadow" role="alert">
										<h4 class="alert-heading"><i class="far fa-check-circle"></i> Complete your registration! </h4>
										<p>Complete your registration to continue FIT. If your having any issues with the registration, please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Coordinator (taw@ucsc.cmb.ac.lk)</a></p>
										<hr>
										<a href="{{ route('student.registration') }}" class="px-0 btn btn-link ">Click here to Complete Registration</a>
								</div>
							</div>
							{{-- /REGISTRATION PENDING --}}
						@endif
				@else
					<div class="col-12 px-0">
							<h4 class="alert-heading text-right">Registration Number: {{ $student->reg_no }}</h4>

							<h5 class="alert-heading text-right">Registration expires on: {{ $registration->registration_expire_at }}</h5>
							<hr>
					</div>
					{{-- RE REGISTRATION ALERT IF NO CURRENT REGISTRATION --}}
					@if($student->current_active_registration() == NULL && $student->last_registration() && $student->processing_registration() == NULL && $student->flag->fit_cert==0)
						<div class="col-12 mt-2">
							<div class="alert alert-danger shadow" role="alert">
									<h4 class="alert-heading"><i class="far fa-check-circle"></i> Your Registration has Expired! </h4>
									<p>Complete your registration to continue FIT. If your having any issues with the registration, please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Coordinator (taw@ucsc.cmb.ac.lk)</a></p>
									<hr>
									<a href="{{ route('payment.reregistration') }}" class="px-0 btn btn-link ">Click here to renew your registration</a>
							</div>
						</div>
					@endif
					{{-- RE REGISTRATION ALERT IF NO CURRENT REGISTRATION --}}
				@endif

				{{-- SITE ANNOUNCEMENTS --}}
				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-header">Site 	Announcements</div>
						<div class="card-body px-4">
							<ul class="mt-5 mr-5">
								@forelse($announcements as $announcement)
									@if($announcement->created_at >= \Carbon\Carbon::today()->subDays(14))
											<li>
												<a class="" href="{{ route('web.announcement', $announcement->id) }}"><strong>{{ $announcement->title }}</strong></a>
												<span class="float-right pr-4 mb-3"><small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d Y') }}</small></span>
												<hr class="mt-2">
											</li>
									@else
											<li>
													<a class="text-dark" href="{{ route('web.announcement', $announcement->id) }}">{{ $announcement->title }}</a>
													<span class="float-right pr-4"><small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d Y') }}</small></span>
													<hr class="mt-2">
											</li>
									@endif
								@empty
									<h5>No announcements</h5>
								@endforelse
							</ul>
						</div>

						@if(!$announcements->isEmpty())
						<div class="card-footer text-right mr-5">
							<p><a href="{{ url('/announcements') }}">View All Announcements</a></p>
						</div>
						@endif

					</div>
				</div>
				{{-- /SITE ANNOUNCEMENTS --}}
			</div>
		</div>
		<!-- /CONTENT -->
	@endif

	@include('portal.student.home.scripts')

@endsection



