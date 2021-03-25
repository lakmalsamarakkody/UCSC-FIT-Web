@component('mail::message')
<h1 style="text-align: center;">Thank you for subscribing to FIT</h1>
<p style="text-align: center;">Your All set! <br> Now you can receive FIT related news everyday</p> 

<p style="text-align: center;">If you feel you are receiving this due to a mistake ,please ignore this email.</p> 
<p style="text-align: center;">If you don't want to receive emails from FIT in the future, <br> please
<a style="color: rgb(27, 25, 153);" href="{{ route('unsubscribe', ['email'=>$details['email'], 'token'=>$details['token']]) }}">unsubscribe</a></p> 

<h5>Thank you,<br>
Admin (FIT - Portal),<br>
University of Colombo School of Computing, <br>
#35, Reid Avenue, Colombo 07, Sri Lanka
</h5>
@endcomponent
