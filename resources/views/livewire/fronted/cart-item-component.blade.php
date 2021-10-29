<tr id='remove-{{$cartItem->rowId}}'>
    <th class="pl-0 border-0" scope="row">
        <div class="media align-cartItems-center">
            <a class="reset-anchor d-block animsition-link" href="{{route('frontend.detail' , $cartItem->model->slug)}}">
                <img src="{{asset("assets/img/products/".  $cartItem->model->firstMedia->file_name)}}" alt="{{$cartItem->model->name}}" width="70"/>
            </a>
        <div class="media-body ml-3">
            <strong class="h6">
                <a class="reset-anchor animsition-link" href="{{route('frontend.detail' , $cartItem->model->slug)}}">
                    {{$cartItem->model->name}}
                </a>
            </strong>
        </div>
        </div>
    </th>
    <td class="align-middle border-0">
        <p class="mb-0 small">${{$cartItem->model->price}}</p>
    </td>
    <td class="align-middle border-0">
        <div class="border d-flex align-cartItems-center justify-content-between px-3">
            <span class="small text-uppercase text-gray headings-font-family">Quantity</span>
        <div class="quantity">
            <button wire:click="increaseQuantity('{{$cartItem->rowId}}')" ><i class="fas fa-caret-left"></i></button>
            <span class="form-control form-control-sm border-0 shadow-0 px-0 text-center">{{$quantity}}</span>
            <button wire:click="decreaseQuantity('{{$cartItem->rowId}}')" ><i class="fas fa-caret-right"></i></button>
        </div>
        </div>
    </td>
    <td class="align-middle border-0">
        <p class="mb-0 small">${{$cartItem->model->price * $cartItem->qty}}</p>
    </td>
    <td class="align-middle border-0">
        <a class="reset-anchor remove" data-remove="{{$cartItem->rowId}}" wire:click.prevent="removeCart('{{$cartItem->rowId}}')" href="#">
            <i class="fas fa-trash-alt small text-muted"></i>
        </a>
    </td>
</tr>
@section('script')
    <script>
        $(".remove").click(function (e) {
            let remove = $(this).data('remove');
            setTimeout(()=>{
                $("#remove-" + remove).remove();
            },3000);
        });
    </script>
@endsection
