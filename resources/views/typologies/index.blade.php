@include('/templates/header')
<div class="flex flex-col w-full">
    <div class="flex flex-wrap w-full bg-gray-100 rounded-lg">
    <div class="flex w-full px-2 text-3xl"><h1>The 16 Typologies by Mayers Briggs</h1></div>
        <?php foreach($personalities as $key => $personality): ?>
            @include('/typologies/personality-card')
        <?php endforeach; ?>
    </div>
</div>
@include('/templates/footer')
