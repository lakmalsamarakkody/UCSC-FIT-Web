@component('mail::message')
<div style="background-color:#14806c; width: 100%; padding: 25px;">

<h1 style="text-align: center; color: #fff;">Verify your e-mail</h1>

<p style="text-align: center; color: #fff;">Verify your email to change your FIT Portal account email by clicking the link below</p> 


<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a style="width:200px; text-align:center" href="{{ route('change.email.verify', ['email'=>$details['email'], 'token'=>$details['token'], 'id'=>$details['id']]) }}" class="button button-success" target="_blank" rel="noopener">Verify</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

<p class="text-white" style="text-align: center; color: #fff !important;">OR <br> Use the Following Link <br><a href="{{ route('change.email.verify', ['email'=>$details['email'], 'token'=>$details['token'], 'id'=>$details['id']]) }}">{{ route('change.email.verify', ['email'=>$details['email'], 'token'=>$details['token'], 'id'=>$details['id']]) }}</a></p>


</div>

<div>
<h4 style="text-align: center;">Need Help? <br><br> Contact System Admin for any system related assistance <br> Call <a href="tel:+94112591080">+94 11 2591080</a> or Email <a href="mailto:admin@fit.bit.lk">admin@fit.bit.lk</a></p>
<h4 style="text-align: center;">Contact Coordinator for Registration related assistance <br> E-mail <a href="mailto:edc@ucsc.cmb.ac.lk">edc@ucsc.cmb.ac.lk</a></p>
</div>

<div style="padding: 0 25px 0 25px; ">
<h5>Thank you,<br>
Admin (FIT- Portal)
</h5> 
</div>

@endcomponent