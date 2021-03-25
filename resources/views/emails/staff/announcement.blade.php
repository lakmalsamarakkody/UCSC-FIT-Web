@component('mail::message')

<h1 style="text-align: center;">New Announcement!</h1>

<h3 style="text-align: center;">{{ $details['title'] }}</h3>


<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
  <a style="width:200px; text-align:center" href="{{ route('web.announcement', ['id'=>$details['id']]) }}" class="button button-success" target="_blank" rel="noopener">View Announcement</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
  
<p style="text-align: center; ">OR <br> Use the Following Link <br><a href="{{ route('web.announcement', ['id'=>$details['id']]) }}" style="color: rgb(0, 49, 139);">{{ route('web.announcement', ['id'=>$details['id']]) }}</a></p>

<p style="text-align: center;">If you feel you are receiving this due to a mistake ,please ignore this email.</p> 

<p style="text-align: center;">If you don't want to receive this type of emails from FIT in the future, <br> please
<a style="color: rgb(27, 25, 153);" href="{{ route('unsubscribe', ['email'=>$details['email'], 'token'=>$details['token']]) }}">unsubscribe</a></p> 

@endcomponent
