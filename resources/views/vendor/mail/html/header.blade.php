<tr>
<td class="header">
<a href="{{ $url }}"  style="width:100%;">
@if (trim($slot) === 'FIT-UCSC')
<img src="{{ asset('img/background/email banner.jpg') }}" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
