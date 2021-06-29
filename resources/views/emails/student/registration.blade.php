@component('mail::message')
<div style="background-color:#473dd4; width: 100%; padding: 25px;">

<h1 style="text-align: center; color: #fff;">Register to FIT</h1>

<p style="text-align: center; color: #fff;">You are all set! <br> Now you can complete your registration for the Foundation of Information Technology by login in to your account by clicking below.</p> 


<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a style="width:200px; text-align:center" href="{{ route('email.link', ['email'=>$details['email'], 'token'=>$details['token']]) }}" class="button button-success" target="_blank" rel="noopener">Login</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

<p class="text-white" style="text-align: center; color: #fff !important;">OR <br> If you’re having trouble clicking the "Check Registration Status" button, copy and paste the URL below into your web browser: <br><a href="{{ route('email.link', ['email'=>$details['email'], 'token'=>$details['token']]) }}">{{ route('email.link', ['email'=>$details['email'], 'token'=>$details['token']]) }}</a></p>


</div>

<div>
<h4 style="text-align: center;">Need Help? <br><br> Contact System Admin for any system related assistance <br> Call <a href="tel:+94112591080">+94 11 2591080</a> or Email <a href="mailto:admin@fit.bit.lk">admin@fit.bit.lk</a></p>
<h4 style="text-align: center;">Contact Coordinator for Registration related assistance <br> E-mail <a href="mailto:edc@ucsc.cmb.ac.lk">edc@ucsc.cmb.ac.lk</a></p>
</div>

<div style="padding: 0 25px 0 25px; ">
<h5>Thank you,<br>
Coordinator (External Degrees Centre),<br>
University of Colombo School of Computing, <br>
#35, Reid Avenue, Colombo 07, Sri Lanka
</h5> 
</div>

@endcomponent
