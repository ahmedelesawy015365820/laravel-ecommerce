<tr id='remove-{{$wishlistItem->rowId}}'>
    <th class="pl-0 border-0" scope="row">
        <div class="media align-items-center">
            <a class="reset-anchor d-block animsition-link" href="{{ route('frontend.detail', $wishlistItem->model->slug) }}">
                <img src="{{ asset("assets/img/products/" . $wishlistItem->model->firstMedia->file_name) }}" alt="{{ $wishlistItem->model->name }}" width="70"/>
            </a>
            <div class="media-body ml-3">
                <strong class="h6">
                    <a class="reset-anchor animsition-link" href="{{ route('frontend.detail', $wishlistItem->model->slug) }}">
                        {{ $wishlistItem->model->name }}
                    </a>
                </strong>
            </div>
        </div>
    </th>
    <td class="align-middle border-0">
        <p class="mb-0 small">${{ $wishlistItem->model->price }}</p>
    </td>
    <td class="align-middle border-0">
        <a  href="#" wire:click.prevent="moveToCart('{{ $wishlistItem->rowId }}')" class="reset-anchor remove" data-remove="{{$wishlistItem->rowId}}">
            Move to cart
        </a>
    </td>
    <td class="align-middle border-0">
        <a href="#" wire:click.prevent="removeFromWishList('{{ $wishlistItem->rowId }}')" class="reset-anchor remove" data-remove="{{$wishlistItem->rowId}}">
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
            },2000);
        });
    </script>
@endsection
