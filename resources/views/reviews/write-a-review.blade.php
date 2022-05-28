@include('templates/header')
<div class="flex flex-col px-3">
    <div class="w-full">
        <div class="card px-4 text-start">
            <?php 
            $ratings = range(1,5);
            $rating = old('rating') ?? @$review->rating;
            ?>
            @include('components/notification')
            <form action="{{ route($route) }}" method="post">
                @csrf
                <input type="hidden" name="review_id" value="{{ @$review->id }}">
                <input type="hidden" name="post_id" value="{{ @$post->id }}">
                <p >Your review will help millions of consumers find trustworthy online businesses and avoid scams.</p>
                
                <div class="mb-4">
                    <label for="review-title" class="mt-3">Title of the review</label>
                    <input type="text" name="title" class="w-full @error('title', 'review') is-invalid @enderror" value="{{ old('title') ?? @$review->title }}" id="review-title" placeholder="Review headline">
                    @error('title', 'review')
                    <div class="text-red-500 bg-red-100 p-1">
                    {{ $errors->review->get('title')[0] }}
                    </div>
                    @enderror
                    <?php 
                    $content_count = (str_word_count(old('content')) ?: @str_word_count($review->content)) ?: 0;
                    ?>
                </div>
                <div class="mb-4">
                    <label for="review-textarea" class="mt-3">Your review (Max {{ $max_words }} words)</label>
                    <textarea max-words="{{ $max_words }}" name="content" rows="6" class="w-full @error('content', 'review') is-invalid @enderror">{{ old('content') ?? @$review->content }}</textarea>Words count: <span id="wordCount">{{ $content_count }}</span>
                    @error('content', 'review')
                    <div class="text-red-500 bg-red-100 p-1">
                    {{ $errors->review->get('content')[0] }}
                    </div>
                    @enderror
                </div>
                <script>
                    const textarea = document.getElementsByName('content')[0];
                    textarea.addEventListener("input", event => {
                        const target = event.currentTarget;
                        const maxLength = target.getAttribute("max-words");
                        const currentLength = target.value.split(' ').length;

                        document.getElementById('wordCount').innerHTML = (`${currentLength}`);
                    });
                </script>

                <div class="mb-4">
                    <p>
                        <h6 class="mb-2">Overall rating</h6>
                        <input type="hidden" id="rating" name="rating" class="" value="{{ $rating ?? 0 }}">
                        <div id="stars" class="mb-2 flex flex-wrap w-full" style="cursor:pointer">
                            <div class="w-full md:w-8/12">
                                @foreach($ratings as $rat)
                                <svg class="rating-star w-6 h-6 inline <?php if ($rat <= $rating) echo 'text-lc-warning' ?>" id="{{ $rat }}" title="Rate {{ $rat }}/10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                @endforeach
                                <span id="rating-value">{{ $rating ? $rating.'/'.count($ratings) : '' }}</span>
                            </div>
                            <div class="w-full md:w-4/12">
                                <span class="ml-3 border p-2 rounded" id="clear-ratings"> Clear ratings </span>
                            </div>
                            <script>
                                    const ratings = <?php echo json_encode($ratings) ?>;
                                    const ratingInput = document.getElementById('rating')
                                    const ratingUIValue = document.getElementById('rating-value')

                                    Array.from(document.getElementsByClassName('rating-star')).forEach(function(node) {
                                        node.addEventListener('mouseover', function() {
                                            let val = parseInt(node.getAttribute('id'))
                                            // adding class
                                            for (var i=1; i<=val; i++) {
                                                document.getElementById(i).classList.add('text-lc-warning');
                                            }
                                            // removing class
                                            for (var i=val + 1; i<=ratings.length; i++) {
                                                document.getElementById(i).classList.remove('text-lc-warning');
                                            }
                                            ratingUIValue.textContent = val+'/'+ratings.length;
                                        })
                                        node.addEventListener('mouseleave', function() {
                                            let val = parseInt(ratingInput.value)
                                            // adding class
                                            for (var i=1; i<=val; i++) {
                                                document.getElementById(i).classList.add('text-lc-warning');
                                            }
                                            // removing class
                                            for (var i=val + 1; i<=ratings.length; i++) {
                                                document.getElementById(i).classList.remove('text-lc-warning');
                                            }
                                            ratingUIValue.textContent = val+'/'+ratings.length;
                                            ratingInput.value = val;
                                        })
                                    })
                                    Array.from(document.getElementsByClassName('rating-star')).forEach(function (node) {
                                        node.addEventListener('click', function() {
                                            let val = parseInt(node.getAttribute('id'))
                                            // adding class
                                            for (var i=1; i<=val; i++) {
                                                document.getElementById(i).classList.add('text-lc-warning');
                                            }
                                            // removing class
                                            for (var i=val + 1; i<=ratings.length; i++) {
                                                document.getElementById(i).classList.remove('text-lc-warning');
                                            }
                                            ratingUIValue.textContent = val+'/'+ratings.length;
                                            ratingInput.value = val;
                                        });
                                    });
                                    // Clear ratings
                                    document.getElementById('clear-ratings').addEventListener('click', function () {
                                        ratingInput.value = 0
                                        ratingUIValue.textContent = '0/'+ratings.length;
                                        Array.from(document.getElementsByClassName('rating-star')).forEach(function(node) {
                                            node.classList.remove('text-lc-warning')
                                        })

                                    })
                                </script>
                        </div>
                    </p>
                </div>
                <hr >
                <div class="flex flex-wrap w-full">
                    <div class="w-full">
                        <div class="flex flex-wrap w-full mx-1 p-2 border-2 @error('certified', 'review') border-error @enderror">
                            <div class="w-1/12 pr-0">
                                <input type="checkbox" name="certified" id="agree-to-tc">
                            </div>
                            <div class="w-11/12 pl-0">
                                <label for="agree-to-tc"> I certify that this review is based on my own experience and that I am in no way affiliated with this business, and have not been offered any incentive or payment from the business to write this review. I agree to Sitejabber’s Terms &amp; Conditions, including to not write false reviews, which is in many cases against the law. </label>
                            </div>
                            @error('certified')
                            <div class="w-full text-red-500 bg-red-100 p-1">
                            Please confirm that you have worked with this company before.
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr >
                <div class="flex flex-wrap w-full mt-2">
                    <div class="w-4/12 mb-2">
                        <button id="btn-submit" class="main-outline-btn">Submit review</submit>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('templates/footer')