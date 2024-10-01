<div>
    <div class="plan-switcher tabs tabs-boxed justify-center w-full bg-white mb-4 dark:bg-gray-900">
        @foreach ($groupedPlans as $interval => $plans)
            <a class="tab bg-white dark:bg-gray-900 dark:text-white text-black {{ $loop->first ? 'tab-active' : '' }}"
                data-target="plans-{{ $interval }}"
                aria-selected="{{ $preselectedInterval == $interval ? 'true' : 'false' }}">{{ $interval }}</a>
        @endforeach
    </div>
    @if ($isGrouped)
        @foreach ($groupedPlans as $interval => $plans)
            <div
                class="plans-container plans-{{ $interval }} {{ $loop->first ? '' : 'hidden' }}  grid max-w-md gap-10 row-gap-5 lg:max-w-screen-lg sm:row-gap-10 lg:grid-cols-3 xl:max-w-screen-lg sm:mx-auto dark:text-white pt-5 pb-5">
                @foreach ($plans as $plan)
                    <x-filament.plans-custom.one :plan="$plan" />
                @endforeach
            </div>
        @endforeach
    @else
        <div
            class="grid max-w-md gap-10 row-gap-5 lg:max-w-screen-lg sm:row-gap-10 lg:grid-cols-3 xl:max-w-screen-lg sm:mx-auto dark:text-white">
            @foreach ($plans as $plan)
                <x-filament.plans-custom.one :plan="$plan" :featured="$featured == $plan->product->slug" />
            @endforeach
        </div>
    @endif
</div>
