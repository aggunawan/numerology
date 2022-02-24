<button
    type="button"
    style="background-color: {{ $backgroundColor ?? '#fff' }}; color: {{ $color ?? '#1f2937' }}"
    class="w-full text-center flex items-center {{ $buttonClass ?? 'p-1' }} text-base font-bold rounded-lg hover:bg-gray-100 group hover:shadow">
    <small class="flex-1 whitespace-nowrap ">{{ $trait }}</small>
</button>
