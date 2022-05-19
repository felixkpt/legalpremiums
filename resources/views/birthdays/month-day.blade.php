@include('/templates/header')
<div class="flex flex-col w-full">
    <div class="flex flex-wrap">
        @include('/birthdays/components/mm-dd')
    </div>
    @include('/people/components/people-header')
</div>
@include('/templates/footer')
