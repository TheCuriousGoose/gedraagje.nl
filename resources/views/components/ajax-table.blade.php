@props(['id', 'ajaxRoute', 'ajaxTable'])

<div>
    <table id="{{ $id }}" data-toggle="table" data-side-pagination="server" data-pagination-parts="['pageList']"
        data-page-list="[5, 10, 25, 50, 100, ALL]" data-pagination="true" data-minimum-count-columns="1"
        data-locale="{{ Auth::user()->locale }}" data-url="{{ $ajaxRoute }}"
        data-classes="table table-hover table-bordered mb-0"
        @foreach ($ajaxTable['options'] as $optionName => $optionValue)
        data-{{ $optionName }}="{{ $optionValue }}" @endforeach>
        <thead class="table-lighter">
            <tr>
                @foreach ($ajaxTable['columns'] as $key => $attributes)
                    <th data-field={{ substr($key, strrpos($key, '.') + 1) }}
                        @if (in_array(substr($key, strrpos($key, '.') + 1), array_values($ajaxTable['sortableColumns']))) data-sortable="true" @endif>{{ __($key) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="table-white"></tbody>
    </table>
</div>
