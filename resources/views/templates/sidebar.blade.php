<!-- Social Media section -->
<div>
    <h3 class="text-xl font-bold text-gray-700 pb-2 mb-2" style="border-bottom: 2px dotted #d1d1d1">Find us on facebook</h3>
    <div class="fb-page" data-href="https://web.facebook.com/LegalPremiums-103666345691405" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://web.facebook.com/LegalPremiums-103666345691405" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/LegalPremiums-103666345691405">LegalPremiums</a></blockquote></div>
</div>
<!-- Trending section -->
@if (isset($trending))
    <h3 class="text-xl font-bold text-gray-700 pb-2 mb-2" style="border-bottom: 2px dotted #d1d1d1">Trending now</h3>
    @include('/posts/components/trending')
@else
    <h3 class="text-xl font-bold text-gray-700 pb-2 mb-2" style="border-bottom: 2px dotted #d1d1d1">Top Rated Companies</h3>
    <?php $trending = App\Models\Post::orderby('rating', 'DESC')->limit(5)->get() ?>
    @include('/posts/components/trending')
@endif