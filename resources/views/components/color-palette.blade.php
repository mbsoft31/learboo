<div class="flex flex-col flex-grow-1 gap-6">
    @foreach(\Core\Support\Colors::getColors() as $name)
        <div class="grid grid-cols-1 md:grid-cols-12 w-full items-center">
            <div class="col-span-1" style="color: {{\Core\Support\Colors::getHexColor($name)}}">
                {{\Illuminate\Support\Str::ucfirst($name->value)}}
            </div>
            <div class="hidden md:grid col-span-11 grid-cols-11 rounded-md overflow-hidden">
                @foreach(\Core\Support\Colors::getVariants() as $variant)
                    <x-color-palette-button class="col-span-1 h-12" :name="$name" :variant="$variant" />
                @endforeach
            </div>

            <div class="md:hidden grid col-span-11 grid-cols-1 rounded-md overflow-hidden">
                @foreach(\Core\Support\Colors::getVariants() as $variant)
                    <x-color-palette-button class="col-span-1 h-12" :name="$name" :variant="$variant" />
                @endforeach
            </div>
        </div>
    @endforeach
</div>
