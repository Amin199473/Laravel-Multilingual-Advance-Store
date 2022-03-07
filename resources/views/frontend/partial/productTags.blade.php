@php
$productTags = App\models\Product::where('status', 1)
    ->inRandomOrder()
    ->limit(6)
    ->get();
@endphp


<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if (session()->get('language') == 'persian')
                @foreach ($productTags as $tag)
                    @php
                        $listOfTags = explode(',', $tag->product_tags_persian);
                    @endphp
                    @foreach ($listOfTags as $tag)
                        <a class="item" title="Phone" href="{{ route('product.tag', $tag) }}">{{ $tag }}</a>
                    @endforeach
                @endforeach
            @else
                @foreach ($productTags as $tag)
                    @php
                        $listOfTags = explode(',', $tag->product_tags_en);
                    @endphp
                    @foreach ($listOfTags as $tag)
                        <a class="item" title="Phone" href="{{ route('product.tag', $tag) }}">{{ $tag }}</a>
                    @endforeach
                @endforeach
            @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
