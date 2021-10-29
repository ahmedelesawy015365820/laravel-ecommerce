<div wire:ignore.self class="modal" id="productView" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                @if ($productModelCount)
                <div class="row align-items-stretch">
                    <div class="col-lg-6 p-lg-0">
                        @foreach ($productModel->media as $media)
                            @if($loop->first)
                                <a class="product-view d-block h-100 bg-cover bg-center"
                                    style="background: url('{{asset("assets/img/products/". $media->file_name)}}')"
                                    href="{{asset("assets/img/products/". $media->file_name)}}"
                                    data-lightbox="productview" title="{{$productModel->name}}">
                                </a>
                            @else
                                <a class="d-none"
                                    href="{{asset("assets/img/products/". $media->file_name)}}"
                                    title="{{$productModel->name}}" data-lightbox="productview">
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <div class="p-5 my-md-4">
                            <ul class="list-inline mb-2" wire:ignore>
                                @if ($productModel->reviews_avg_rating != null)
                                    @for($i= 1; $i <= 5; $i++)
                                        @if (round($productModel->reviews_avg_rating) >= $i)
                                        <li class="list-inline-item m-0"><i class="fas fa-star fa-sm text-warning"></i></li>
                                        @else
                                        <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                        @endif
                                    @endfor
                                @else
                                    <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                @endif
                            </ul>
                            <h2 class="h4">{{$productModel->name}}</h2>
                            <p class="text-muted">${{$productModel->price}}</p>
                            <p class="text-small mb-4">{!! $productModel->description !!}</p>
                            <div class="row align-items-stretch mb-4">
                                <div class="col-sm-7 pr-sm-0">
                                    <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                        <div class="quantity">
                                            <button wire:click="increaseQuantity()"><i class="fas fa-caret-left"></i></button>
                                            <input class="form-control border-0 shadow-0 p-0" type="text" wire:model="quantity" readonly>
                                            <button wire:click="decreaseQuantity()"><i class="fas fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 pl-sm-0">
                                    <a wire:click="addCart()" class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0">Add to cart</a>
                                </div>
                            </div>
                            <a class="btn btn-link text-dark p-0" wire:click="addwishlist()>
                                <i class="far fa-heart mr-2"></i>Add to wish list
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
