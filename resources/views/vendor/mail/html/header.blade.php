@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{asset('assets/images/logos/logo_cuji.png')}}" class="logo" alt="El Cují Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
