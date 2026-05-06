@if (app()->getLocale() === 'en')
    @include('structure::landing_en')
@else
    @include('structure::landing_ar')
@endif
