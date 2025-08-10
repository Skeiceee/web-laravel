<div>
    <a wire:click="toggle" href="#" class="cursor-pointer">
        @if ($hearteable->isHearted())
            <span class="text-red-600">&hearts;</span>
        @else
            <span class="text-gray-600">&hearts;</span>
        @endif
    </a>
</div>
