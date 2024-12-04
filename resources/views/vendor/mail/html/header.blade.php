<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'ALCALDÍA DE PUERTO BOYACÁ - INVENTARIO DOCUMENTAL')
<img src="https://www.idamptoboy.com/homeland/images/about.jpg" class="logo" alt="Alcaldia Logo">
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
