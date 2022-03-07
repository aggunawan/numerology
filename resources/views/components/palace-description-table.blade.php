<div class="table-responsive">
    <table class="table table-compact">
        <thead>
        <tr>
            <th>Row</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attributes as $attribute)
            @if($palaceDescription->{$attribute})
                @foreach($palaceDescription->{$attribute} as $i => $val)
                    <tr>
                        <td>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $attribute)) . ' ' . $i }}</td>
                        <td>{{ $val['Description'] }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
</div>
