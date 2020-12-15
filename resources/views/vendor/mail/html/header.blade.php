<tr>
<td class="header">
<a href="{{ $url }}"  style="width:100%;">
@if (trim($slot) === 'FIT-UCSC')
<img src="https://lh3.googleusercontent.com/pw/ACtC-3eEWkmkL6-lgJhF58IoLRu9f1HgpLtkYE3ca_pIgD6Pm6ubV6jonFNdjZt2MoH4cKaQdkgk5n51d3j8eML8_uCyylwtkI2fNiW6c6L5JVELPsmwLQabSyLBPbGGqsd6htDDVIwusjYoVbTlEpWP6rU=w1440-h582-no?authuser=0" class="logo" alt="FIT Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
