@foreach ($data->item as $item)
<div class="col-md-5 uk-card-default uk-card-body">
   <h3>{{ $item->title }}</h3>
   <div class="uk-divider-small">
      <small>{{ $item->pubDate }}</small>
      <small>{{ $item->author }}</small>
   </div>
   <p>
      {{ $item->description }}
   </p>
   <a class="uk-button uk-button-primary" href="{{ $item->link }}">Bekijk</a>
</div>
@endforeach
