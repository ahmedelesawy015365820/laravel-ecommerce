<div>
    <section class="py-5">
        <div class="container p-0">
          <div class="row">
            <!-- SHOP SIDEBAR-->
            <div class="col-lg-3 order-2 order-lg-1">
              <h5 class="text-uppercase mb-4">Categories</h5>
              @forelse ($categories as $category)
                <div class="py-2 px-4 bg-dark text-white mb-3">
                    <strong class="small text-uppercase font-weight-bold">
                        {{$category->name}}
                    </strong>
                </div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                    @forelse ($category->category_product as $categoryProduct)
                        <li class="mb-2">
                            <a class="reset-anchor" href="{{route('frontend.subcategory',$categoryProduct->slug)}}">
                                {{$categoryProduct->name}}
                            </a>
                        </li>
                    @empty
                    @endforelse
                </ul>

              @empty
              @endforelse

                <h5 class="text-uppercase mb-4">Tags</h5>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                    @forelse($tags as $tag)
                        <li class="mb-2">
                            <a class="reset-anchor" href="{{ route('frontend.tag', $tag->slug) }}">
                                {{ $tag->name }}
                            </a>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </div>
            <!-- SHOP LISTING-->
            <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
              <div class="row mb-3 align-items-center">
                <div class="col-lg-6 mb-2 mb-lg-0">
                  <p class="text-small text-muted mb-0">Showing {{$Products->firstItem()}}–{{$Products->lastItem()}} of {{$Products->total()}} results</p>
                </div>
                <div class="col-lg-6">
                  <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                    <li class="list-inline-item text-muted mr-3" id="tweItem">
                        <a class="reset-anchor p-0" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    <li class="list-inline-item text-muted mr-3" id="threeItem">
                        <a class="reset-anchor p-0" href="#">
                            <i class="fas fa-th"></i>
                        </a>
                    </li>
                    <li class="list-inline-item" wire:ignore>
                      <select wire:ignore class="selectpicker ml-auto" wire:model="sortingBy" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                        <option value="default">Default sorting</option>
                        <option value="popularity">Popularity</option>
                        <option value="low-high">Price: Low to High</option>
                        <option value="high-low">Price: High to Low</option>
                      </select>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <!-- PRODUCT-->
                @foreach ($Products as $product)
                <div class="col-lg-4 col-sm-6 products">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white badge-"></div>
                        <a class="d-block" href="{{route('frontend.detail', $product->slug)}}">
                            <img class="img-fluid w-100" src="{{asset("assets/img/products/".$product->firstMedia->file_name)}}" alt="{{$product->name}}">
                        </a>
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0">
                                <a class="btn btn-sm btn-outline-dark" wire:click="addwishlist('{{$product->id}}')">
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                            <li class="list-inline-item m-0 p-0">
                                <a class="btn btn-sm btn-dark" wire:click="addCart('{{$product->id}}')">Add to cart</a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn btn-sm btn-outline-dark" wire:click.prevent="$emit('productModelShow','{{$product->slug}}')" data-target="#productView" data-toggle="modal">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <h6>
                           <a class="reset-anchor" href="{{route('frontend.detail', $product->slug)}}">{{$product->name}}</a>
                       </h6>
                      <p class="small text-muted">${{$product->price}}</p>
                    </div>
                  </div>
                @endforeach
              </div>
              <!-- PAGINATION-->
              {!! $Products->onEachSide(1)->links() !!}
            </div>
          </div>
        </div>
      </section>
</div>

@section('script')
    <script>

        let products = document.querySelectorAll('.products');

        $('#tweItem').click(function () {

            products.forEach(function (product) {

                if(product.classList.contains('col-lg-4')){

                    product.classList.remove('col-lg-4');
                    product.classList.add('col-lg-6');
                }

            });

        });

        $('#threeItem').click(function () {

            products.forEach(function (product) {

                if(product.classList.contains('col-lg-6')){

                    product.classList.remove('col-lg-6');
                    product.classList.add('col-lg-4');
                }

            });

        });
    </script>
@endsection
