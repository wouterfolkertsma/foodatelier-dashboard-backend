@foreach ($data->item as $item)
<div class="rss-article uk-card-default uk-card-body" data-url="{{ $item->link }}" style="background-image: url('{{ $item->image }}')">
   <h3>{{ $item->title }}</h3>
   <div class="uk-divider-small"></div>
   <small>{{ $item->pubDate }}</small>
   <small>{{ $item->author }}</small>
   <p>
      {{ $item->description }}
   </p>
   <a class="uk-button uk-button-primary-inverse" href="{{ $item->link }}">Bekijk</a>
</div>
@endforeach
