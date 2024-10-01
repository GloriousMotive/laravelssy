<div
    class="relative flex flex-col justify-between p-8 transition-shadow duration-300 border rounded shadow-sm sm:items-center hover:shadow border-deep-purple-accent-400">

    <div class="text-center">
        <div class="text-lg font-semibold">{{ __($plan->product->name) }}</div>
        <div class="flex items-center justify-center mt-2">
            <div class="mr-1 text-4xl font-bold">@money($plan->prices[0]->price, $plan->prices[0]->currency->code)</div>
            <div class="text-sm">/ {{ $plan->interval_count > 1 ? $plan->interval_count : '' }}
                {{ __($plan->interval->name) }}</div>
        </div>
        <div class="mt-3 space-y-3">
            <ul>
                @if ($plan->product->features)
                    @foreach ($plan->product->features as $feature)
                        <li>{{ $feature['feature'] }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="w-full">
        <a class="btn btn-block bg-primary-500 dark:bg-primary text-white px-6 mt-6 border-0 hover:bg-primary-500/90"
            href="{{ route('checkout.subscription', $plan->slug) }}">
            {{ __('Buy') }} {{ $plan->product->name }}
        </a>
    </div>
</div>
