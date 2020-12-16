@component('mail::message')
<div style="background-color:#473dd4; width: 100%; padding: 25px;">

<h1 style="text-align: center; color: #fff;">Register to FIT</h1>

<p style="text-align: center; color: #fff;">Your All set! <br> Now you can complete your registration for the Foundation of Information Technology by login in to your by clicking below.</p> 


@component('mail::button', ['url' => 'http://127.0.0.1:8000/{{ $details->email }}/{{ $details->token }}', 'color' => 'success'])
Login
@endcomponent

<p style="text-align: center; color: #fff;">OR <br> Use the Following Link <br><a href="http://127.0.0.1:8000/{{ $details->email }}/{{ $details->token }}">http://www.sample.com/sample/sample</a></p>


</div>

<div>
<h4 style="text-align: center;">Need Help? <br><br> Contact System Admin for any system related assistance <br> Call <a href="tel:+94112591080">+94 11 2591080</a> or Email <a href="mailto:admin@fit.bit.lk">admin@fit.bit.lk</a></p>
<h4 style="text-align: center;">Contact Coordinator for Registration related assistance <br> E-mail <a href="mailto:taw@ucsc.cmb.ac.lk">taw@ucsc.cmb.ac.lk</a></p>
</div>

<div style="padding: 0 25px 0 25px; ">
<h5>Thank you,<br>
Coordinator (External Degrees Centre),<br>
University of Colombo School of Computing, <br>
#35, Reid Avenue, Colombo 07, Sri Lanka
</h5> 
</div>

@endcomponent
