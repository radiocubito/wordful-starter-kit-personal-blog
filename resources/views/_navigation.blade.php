<section class="mt-12 text-center">
    <p class="text-sm lg:text-base text-gray-500 mt-4 mb-3">
        @foreach (config('site.navigation') as $link)
            <a class="hover:underline hover:text-gray-700 font-medium" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
            @unless ($loop->last)
                <span aria-hidden="true"> · </span>
            @endunless
        @endforeach
    </p>
</section>
