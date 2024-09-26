<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Inventario Documental (IDAM)')
<img src="homeland/images/about.png" class="logo" alt="Alcaldia Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
