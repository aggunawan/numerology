<button
    type="button"
    style="background-color: {{ $backgroundColor ?? '#fff' }}; color: {{ $color ?? '#1f2937' }}"
    data-modal-toggle="{{ \Illuminate\Support\Str::camel($trait) }}"
    class="w-full text-center rounded-lg flex items-center {{ $buttonClass ?? 'p-0' }} text-base font-bold hover:bg-gray-100 group hover:shadow">
    <small class="flex-1 whitespace-nowrap ">{{ $trait }}</small>
</button>
