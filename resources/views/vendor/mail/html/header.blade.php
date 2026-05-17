@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
      <img src="https://i.ibb.co.com/C3v1H3hB/logos.jpg" style="max-width:500px; height: auto;" 
                 alt="Percetakan Matahari" class="w-16 h-16 rounded-lg object-cover shadow-md">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
