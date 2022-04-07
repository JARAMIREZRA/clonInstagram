<div class="card pub_image">
    <div class="card-header">
        <div class="container-avatar">
            @if ($image->user->image)
            <img src="{{ route('user.avatar', ['filename' => $image->user->image])}}" alt="" class="avatar" />
            @endif           
        </div>
        <div class="data-user">
            <a href="{{ route('user.profile', ['id' => $image->user->id]) }}">{{ $image->user->nick }}</a>
            |
            <span class="nickname">{{ $image->user->name. ' ' .$image->user->last_name }} </span>
        </div>
    </div>                    
    <div class="card-body">
        <section>
            <div class="image-container">
                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="" />
            </div>
            <div class="likes">
                @php
                    $user_like = false;
                @endphp
                @foreach ($image->likes as $like)
                    @if ($like->user->id == Auth::user()->id)
                        @php
                            $user_like = true;
                        @endphp
                    @endif   
                @endforeach

                @if ($user_like)
                <a href="#" class="like btn-dislike" data-id="{{ $image->id }}" style="color: red">
                    <i class="fas fa-heart fa-2x"></i>
                </a>   
                @else
                <a href="#" class="like btn-like" data-id="{{ $image->id }}">
                    <i class="far fa-heart fa-2x"></i>
                </a>    
                @endif
                <span class="num_likes">{{ count($image->likes) }}</span>
                
                <a href="{{ route('image.show', ['id' => $image->id]) }}" class="like">
                    <i class="far fa-comment fa-2x"></i>&nbsp;<span class="num-comment">({{ count($image->comments) }})</span>
                </a>
            </div>
        
            <div class="description">
                <p class="nickname">{{ '@'.$image->user->nick }}</p> 
                <span>{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
                <p>{{ $image->description }}</p>
            </div>
        </section>
    </div>
</div>