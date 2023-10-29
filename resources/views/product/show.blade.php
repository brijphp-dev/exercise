<x-layout>
    <h1>{{ $product->name }}</h1>

    <div class="product-page">
        <div>
            <img src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}">
            @if($product->images->count())
                <span style="display: block;float: left;width: 100%;font-weight: bold;border-bottom: 1px solid;">Extra Images</span>
                @foreach ($product->images as $product_img)
                    <img src="{{ asset('images/product/' . $product_img->product_image_url) }}" alt="{{ $product->name }}" style="width:150px; margin: 10px; border:1px solid gray; float:left;">
                @endforeach
            @endif
        </div>

        <div>
            {!! $product->description !!}

            <p>&pound;{{ $product->price }}</p>
        </div>
        <div class="container">
            <p  class="alert alert-primary">Enquiry for {{ $product->name }}</p>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('product_enquiry', ['product' => $product->id]) }}">
                @csrf
                <div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
                    <label for="name">Full Name</label>
                    <input name="fullname" type="text" class="form-control" id="fullname" value="{{ old('fullname') }}">
                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" value="{{ old('email') }}">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                    <label for="exampleInputPassword1">Enquiry</label>
                    <textarea name="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="container">
            <p  class="alert alert-primary">Upload Multiple Images for {{ $product->name }}</p>
            <!-- a href = "{{ route('product_multiple_images', ['product' => $product->id]) }}">Upload Multiple Images for this Product</a -->
            @if(session('img_success'))
                <div class="alert alert-success">{{ session('img_success') }}</div>
            @endif
            <form method="POST" action="{{ route('product_multiple_images') }}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="productid" value="{{ $product->id }}">
                <div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
                    <label for="name">Choose Product Images</label>
                    <input type="file"  name="productimages[]" multiple>
                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-layout>