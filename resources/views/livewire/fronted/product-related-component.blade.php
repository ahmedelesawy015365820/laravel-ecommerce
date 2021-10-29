<div class="col-lg-3 col-sm-6">
    <div class="product text-center skel-loader">
      <div class="d-block mb-3 position-relative">
          <a class="d-block" href="{{route('frontend.detail', $item->slug)}}">
              <img class="img-fluid w-100" src="{{ asset("assets/img/products/".$item->firstMedia->file_name)}}" alt="{{$item->name}}">
          </a>
        <div class="product-overlay">
          <ul class="mb-0 list-inline">
              <li class="list-inline-item m-0 p-0">
                  <a class="btn btn-sm btn-outline-dark" wire:click="addwishlist()">
                      <i class="far fa-heart"></i>
                  </a>
              </li>
              <li class="list-inline-item m-0 p-0">
                  <a class="btn btn-sm btn-dark" wire:click="addCart()">Add to cart</a>
              </li>
              <li class="list-inline-item mr-0">
                  <a class="btn btn-sm btn-outline-dark" data-target="#productView" wire:click="$emit('productModelShow','{{$item->slug}}')" data-toggle="modal">
                      <i class="fas fa-expand"></i>
                  </a>
              </li>
          </ul>
        </div>
      </div>
      <h6> <a class="reset-anchor" href="{{route('frontend.detail', $item->slug)}}">{{$item->name}}</a></h6>
      <p class="small text-muted">${{$item->price}}</p>
    </div>
  </div>
