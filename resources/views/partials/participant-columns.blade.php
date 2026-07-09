@php
    $items = collect($items)->values();
    $half = max((int) ceil($items->count() / 2), 1);
@endphp
<div class="participant-list">
    @foreach($items->chunk($half) as $column)
        <div class="participant-col">
            @foreach($column as $participant)
                <article class="participant-item">
                    <div>
                        <h3>{{ $participant->name }}</h3>
                        @if($participant->kedi)
                            <p>{{ $participant->kedi }}</p>
                        @endif
                    </div>
                    @if(($showBadges ?? false) && $participant->categories)
                        <div class="participant-badges">
                            @foreach($participant->categories as $category)
                                <span class="participant-category">{{ $category }}</span>
                            @endforeach
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    @endforeach
</div>
