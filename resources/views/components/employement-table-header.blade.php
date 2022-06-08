<th class="px-4 py-3 whitespace-nowrap" wire:click="setOrderField('{{ $name }}')">

    {{ $slot }}

    @if ($visible)
        @if ($direction === 'ASC')
            <span><i class="bi-caret-down-fill"></i></span>
        @else
            <span><i class="bi-caret-up-fill"></i></span>
        @endif
    @endif

</th>