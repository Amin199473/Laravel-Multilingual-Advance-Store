@php
$categories = App\models\Category::orderBy('category_name_en', 'ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            @foreach ($categories as $category)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}"
                           aria-hidden="true"></i>{{ session()->get('language') == 'persian' ? $category->category_name_persian : $category->category_name_en }}</a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                <!-- subcategories -->
                                @foreach ($category->subcategories as $subcategory)
                                    <div class="col-sm-12 col-md-3">
                                        <a href="{{ route('subcategory.products', [$subcategory->id, $subcategory->subcategory_slug_en]) }}">
                                            <h2 class="title">
                                                {{ session()->get('language') == 'persian' ? $subcategory->subcategory_name_persian : $subcategory->subcategory_name_en }}
                                            </h2>
                                        </a>
                                        <ul class="links list-unstyled">
                                            @foreach ($subcategory->subsubcategories as $sub_sub_cat)
                                                <li><a href="{{ route('subsubcategory.products', [$sub_sub_cat->id, $sub_sub_cat->subsubcategory_slug_en]) }}">{{ session()->get('language') == 'persian' ? $sub_sub_cat->subsubcategory_name_persian : $sub_sub_cat->subsubcategory_name_en }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /.col -->
                                @endforeach
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- /.menu-item -->
            @endforeach
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
