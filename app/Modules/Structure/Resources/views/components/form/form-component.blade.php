@props(['route', 'method' => 'POST', 'enctype' => null])

<form action="{{ $route }}" method="{{ $method }}" @if($enctype) enctype="{{ $enctype }}" @endif {{ $attributes }}>
    @csrf
    @if($method !== 'GET' && $method !== 'POST')
        @method($method)
    @endif
    
    {{ $slot }}
    
    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="feather icon-save"></i>
            {{ __('dashboard.save') }}
        </button>
    </div>
</form>

